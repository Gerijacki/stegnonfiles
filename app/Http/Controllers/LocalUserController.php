<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class LocalUserController extends Controller
{
    public function createAdmin()
    {
        if (app()->environment('local')) {
            $user = User::create([
                'name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('stegnonfiles1234'),
            ]);

            return response()->json([
                'message' => 'Usuario admin creado con éxito.',
                'user' => $user,
            ]);
        }

        return response()->json([
            'message' => 'Este método solo puede ejecutarse en el entorno local.',
        ], 403);
    }
}
