<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use App\Services\FileEncryptionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Illuminate\Support\Facades\Response;

class UploadController extends Controller
{
    protected $encryptor;

    public function __construct(FileEncryptionService $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    public function showForm()
    {
        return view('upload.form');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|max:10240',
            'password' => 'nullable|string|min:4'
        ]);

        $file = $request->file('file');
        $raw = file_get_contents($file->getRealPath());
        $originalName = $file->getClientOriginalName();
        $mimeType = $file->getMimeType();

        $fileKey = $this->encryptor->generateKey();
        $firstLayer = $this->encryptor->encrypt($raw, $fileKey);
        $firstEncrypted = $firstLayer['data'];
        $ivBase = $firstLayer['iv'];

        $finalData = $firstEncrypted;
        $salt = null;
        $ivUser = null;
        $hasPassword = false;

        if ($request->filled('password')) {
            $salt = random_bytes(16);
            $userKey = $this->encryptor->deriveKeyFromPassword($request->input('password'), $salt);
            $userLayer = $this->encryptor->encrypt($finalData, $userKey);
            $finalData = $userLayer['data'];
            $ivUser = $userLayer['iv'];
            $hasPassword = true;
        }

        $uuid = (string) Str::uuid();
        $filename = "$uuid.enc";
        Storage::put("private/$filename", $finalData);

        $upload = Upload::create([
            'uuid' => $uuid,
            'path' => "private/$filename",
            'original_filename' => $originalName,
            'mime_type' => $mimeType,
            'encryption_key' => Crypt::encrypt(base64_encode($fileKey)),
            'user_password_salt' => $salt,
            'iv_user_password' => $ivUser,
            'iv_base_encryption' => $ivBase,
            'has_password' => $hasPassword,
        ]);

        return redirect()->route('upload.success', ['uuid' => $upload->uuid]);
    }

    public function success($uuid)
    {
        return view('upload.success', ['uuid' => $uuid]);
    }

    public function downloadForm($uuid)
    {
        $upload = Upload::where('uuid', $uuid)->firstOrFail();
        return view('upload.download', ['upload' => $upload]);
    }

    public function download(Request $request, $uuid)
    {
        $upload = Upload::where('uuid', $uuid)->firstOrFail();
        $encryptedData = Storage::get($upload->path);
        $fileKey = base64_decode(Crypt::decrypt($upload->encryption_key));

        if ($upload->has_password) {
            $request->validate(['password' => 'required|string']);
            $userKey = $this->encryptor->deriveKeyFromPassword($request->input('password'), $upload->user_password_salt);
            $firstLayerData = $this->encryptor->decrypt($encryptedData, $userKey, $upload->iv_user_password);

            if ($firstLayerData === false) {
                return back()->withErrors(['password' => 'Contraseña incorrecta']);
            }
        } else {
            $firstLayerData = $encryptedData;
        }

        $decrypted = $this->encryptor->decrypt($firstLayerData, $fileKey, $upload->iv_base_encryption);

        return Response::make($decrypted, 200, [
            'Content-Type' => $upload->mime_type ?? 'application/octet-stream',
            'Content-Disposition' => (new ResponseHeaderBag())->makeDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $upload->original_filename ?? 'archivo_descargado'
            ),
        ]);
    }
}
