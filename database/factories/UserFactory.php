<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $gender = $this->faker->randomElement(['male', 'female']);

        $firstName = $this->faker->firstName($gender);
        $nickName = $this->faker->firstName($gender);
        $middleName = $this->faker->randomElement([$this->faker->lastName($gender), null]);
        $lastName = $this->faker->lastName($gender);
        $username = strtolower($firstName);

        $birthdate = $this->faker->date('Y-m-d', '2002-01-01');
        $location = $this->faker->address();
        $contact = (int)$this->faker->numerify('9#########');

        $email = strtolower($firstName).'@gmail.com';
        $emailVerified = $this->faker->randomElement([Carbon::parse(now())->toDateString(), $this->faker->dateTimeThisDecade(), null]);

        $password = strtolower($firstName).'123';

        $ip = $this->faker->ipv4();
        $userAgent = $this->faker->userAgent();

        $githubId = (int)$this->faker->numerify('#########');
        $githubAvatar = $this->faker->imageUrl($word = 'avatar');
        $githubJoined = $this->faker->date('Y-m-d', '2023-01-01');
        $githubJoined = $this->faker->dateTimeThisDecade();

        $googleId = (int)$this->faker->numerify('#################');
        $googleAvatar = $this->faker->imageUrl($word = 'avatar');

        $facebookId = (int)$this->faker->numerify('###############');
        $facebookAvatar = $this->faker->imageUrl($word = 'avatar');

        return [

            'username' => $username,
            'given_name' => $firstName,
            'middle_name' => $middleName,
            'family_name' => $lastName,
            'nickname' => $nickName,

            'birthdate' => $birthdate,
            'location' => $location,
            'gender' => $gender,
            'contact' => $contact,

            'email' => $email,
            'email_verified_at' => $emailVerified,

            'password' => $password,

            'ip' => $ip,
            'user_agent' => $userAgent,

            'github_id' => $githubId,
            'github_name' => "{$firstName} {$middleName} {$lastName}",
            'github_avatar_url' => $githubAvatar,
            'github_page_url' => null,
            'github_joined_date' => $githubJoined,

            'google_id' => $googleId,
            'google_name' => "{$firstName} {$middleName} {$lastName}",
            'google_avatar_url' => $googleAvatar,

            'facebook_id' => $facebookId,
            'facebook_name' => "{$firstName} {$middleName} {$lastName}",
            'facebook_avatar_url' => $facebookAvatar,
            'facebook_profile_url' => null,

            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
