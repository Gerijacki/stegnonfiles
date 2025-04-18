<?php

namespace App\Services;

class FileEncryptionService
{
    public function generateKey(): string
    {
        return random_bytes(32);
    }

    public function encrypt(string $data, string $key): array
    {
        $iv = random_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $key, 0, $iv);

        return ['data' => $encrypted, 'iv' => $iv];
    }

    public function decrypt(string $data, string $key, string $iv): string
    {
        return openssl_decrypt($data, 'aes-256-cbc', $key, 0, $iv);
    }

    public function deriveKeyFromPassword(string $password, string $salt): string
    {
        return hash_pbkdf2('sha256', $password, $salt, 100000, 32, true);
    }
}
