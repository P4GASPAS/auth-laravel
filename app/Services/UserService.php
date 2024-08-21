<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function create($payload)
    {
        $user = User::create([
            'username' => $payload['username'],
            'given_name' => $payload['first_name'],
            'middle_name' => $payload['middle_name'],
            'family_name' => $payload['last_name'],
            'nickname' => $payload['nickname'],

            'birthdate' => $payload['birthdate'],
            'location' => $payload['location'],
            'gender' => $payload['gender'],
            'contact' => $payload['contact'],

            'email' => $payload['email'],

            'password' => $payload['password'],

            'ip' => $payload['ip'] ?? null,
            'user_agent' => $payload['userAgent'] ?? null,
        ]);

        return $user;
    }
}