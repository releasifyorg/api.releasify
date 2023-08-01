<?php

declare(strict_types=1);

namespace Domain\User\Controllers;

use App\Support\Parents\ParentController;
use Domain\User\Models\User;
use Domain\User\Requests\GithubCallbackRequest;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GithubCallbackController extends ParentController
{
    public function __construct(
        private readonly Client $http
    ) {
    }

    public function __invoke(GithubCallbackRequest $request)
    {
        try {


            $code = $request->code;

            $response = $this->http->post('https://github.com/login/oauth/access_token',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                    'json' => [
                        'client_id' => config('services.github.client_id'),
                        'client_secret' => config('services.github.client_secret'),
                        'code' => $code
                    ]
                ]);

            $params = json_decode((string) $response->getBody(), true);

            $accessToken = $params['access_token'];

            $userResponse = $this->http->get('https://api.github.com/user', [
                'headers' => [
                    'Authorization' => 'token ' . $accessToken
                ]
            ]);

            $userData = json_decode((string) $userResponse->getBody(), true);

            $user = $this->getOrCreateUser($userData);

            $token = $user->createToken(env('APP_NAME'))->plainTextToken;

            return $this->success($token);
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    private function getOrCreateUser(array $userData)
    {
        $user = User::query()
            ->where('github_id', $userData['id'])
            ->first();

        if (
            $user
        ) {
            return $user;
        }

        $password = Str::password(12);

        $user = User::create([
            'name' => $userData['name'],
            'username' => $userData['login'],
            'github_id' => $userData['id'],
            'avatar_url' => $userData['avatar_url'],
            'email' => $userData['email'],
            'password' => Hash::make($password),
        ]);

        if ($user->email) {
            //TODO: send email with password
            ray($password);
        }

        return $user;
    }
}
