<?php

declare(strict_types=1);

namespace App\Services;

use App\Http\Casts\RoketChat\UserInfoFacade;
use App\Http\Casts\RoketChat\UserWrapper;
use App\Models\User;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

final class RocketChatService
{
    private string $server;
    private string $username;
    private string $password;
    private int $tokenLifeTime;
    private array $headers = [];

    public function __construct()
    {
        $config = config('services.rocket_chat');
        $this->server = $config['server'];
        $this->username = $config['username'];
        $this->password = $config['password'];
        $this->tokenLifeTime = (int) $config['token_life_time'];

        $this->asAdmin();
    }

    public function baseUrl(string $server): self
    {
        $this->server = $server;

        return $this;
    }

    public function withHeaders(array $headers): self
    {
        $this->headers = array_merge($this->headers, $headers);

        return $this;
    }

    public function as(UserWrapper $user): self
    {
        $this->withHeaders([
            'X-Auth-Token' => $user->getAuthToken(),
            'X-User-Id' => $user->getId(),
        ]);

        return $this;
    }

    public function asAdmin(): self
    {
        $this->as($this->login($this->username, $this->password));

        return $this;
    }

    public function send(string $url, array $payload, string $method = 'post'): ?Response
    {
        $request = Http::baseUrl($this->server)
            ->withHeaders($this->headers)
            ->{$method}($this->server.$url, $payload);

        if ($request->failed()) {
            throw new \Exception($request->body());
        }

        return $request;
    }

    public function get(string $url, array $payload): ?Response
    {
        return $this->send($url, $payload, 'get');
    }

    public function post(string $url, array $payload): ?Response
    {
        return $this->send($url, $payload);
    }

    public function login(string $email, string $password): UserWrapper
    {
        /** @var array */
        $cached = Cache::remember('rc.users.'.$email, $this->tokenLifeTime, function () use ($email, $password) {
            return $this->post('/api/v1/login', [
                'user' => $email,
                'password' => $password,
            ])->json('data');
        });

        return new UserWrapper($cached);
    }

    public function logout(string $email): void
    {
        $this->post('/api/v1/logout', []);
    }

    public function createUser(User $user, string $password): ?Response
    {
        return $this->post('/api/v1/users.create', [
            'email' => $user->email,
            'name' => $user->profile->first_name.' '.$user->profile->middle_name,
            'password' => $password,
            'username' => Str::snake($user->usercode, '.'),
            'joinDefaultChannels' => true,
            'verified' => true,
        ]);
    }

    public function getUserInfo(string $userId): ?UserInfoFacade
    {
        $response = $this->get('/api/v1/users.info', [
            'userId' => $userId,
        ])->json();

        return $response['success'] ?? false
            ? new UserInfoFacade($response['user'])
            : null;
    }

    public function getUserList(array $query = []): ?array
    {
        $response = $this->get('/api/v1/users.list', [
            'fields' => json_encode(['emails' => 1, 'name' => 1]),
            'query' => json_encode($query),
        ])->json();

        return $response['success'] ?? false
            ? $response['users']
            : null;
    }

    public function userExist(string $email): bool
    {
        $response = $this->getUserList(['emails.address' => $email]);

        return !is_null($response) && !empty($response) && count($response) > 0;
    }

    public function getResumeToken(string $userId): ?string
    {
        /** @var ?string */
        $token = Cache::remember('rc.resume_token.'.$userId, $this->tokenLifeTime, function () use ($userId) {
            $response = $this->post('/api/v1/users.createToken', [
                'userId' => $userId,
            ])->json();

            return $response['success'] ?? false
                ? (string) $response['data']['authToken']
                : null;
        });

        return $token;
    }

    public function updateUser(array $payload): ?Response
    {
        return $this->post('/api/v1/users.update', $payload);
    }
}
