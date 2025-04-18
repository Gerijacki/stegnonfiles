<form method="POST" action="{{ route('upload.upload') }}" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file" required>
    <input type="text" name="password" placeholder="Contraseña (opcional)">
    <button type="submit">Subir archivo</button>
</form>
