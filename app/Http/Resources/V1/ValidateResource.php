<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ValidateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'username' => $this->username,
            'firstName' => $this->given_name,
            'middleName' => $this->middle_name,
            'lastName' => $this->family_name,
            'nickname' => $this->nickname,

            'birthdate' => $this->birthdate,
            'location' => $this->location,
            'gender' => $this->gender,
            'contact' => $this->contact,

            'email' => $this->email,
            'emailVerifiedAt' => $this->email_verified_at,

            'githubId' => $this->github_id,
            'githubName' => $this->github_name,
            'githubAvatarUrl' => $this->github_avatar_url,
            'githubPageUrl' => $this->github_page_url,
            'githubJoinedDate' => $this->github_joined_date,

            'googleId' => $this->google_id,
            'googleName' => $this->google_name,
            'googleAvatarUrl' => $this->google_avatar_url,
            
            'facebookId' => $this->facebook_id,
            'facebookName' => $this->facebook_name,
            'facebookAvatarUrl' => $this->facebook_avatar_url,
            'facebookProfileUrl' => $this->facebook_profile_url,
        ];
    }
}
