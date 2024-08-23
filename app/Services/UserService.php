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

    public function createOrUpdateGithubProfile($payload)
    {
        $user = User::updateOrCreate(
            ['github_id' => $payload['id']],
            [
                'nickname' => $payload['nickname'] ?? null,
                'email' => $payload['email'] ?? null,
                'github_id' => $payload['id'],
                'github_name' => $payload['name'],
                'github_avatar_url' => $payload['avatar'] ?? null,
                'github_page_url' => $payload['user']['html_url'] ?? null,
                'github_joined_date' => $usepayload['user']['created_at'] ?? null
            ]
        );

        return $user;
    }
}