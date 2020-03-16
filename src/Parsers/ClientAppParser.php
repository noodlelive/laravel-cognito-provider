<?php declare(strict_types=1);

namespace CustomerGauge\Cognito\Parsers;

use CustomerGauge\Cognito\Contracts\ClientAppRepository;
use CustomerGauge\Cognito\TokenVerifier;
use Illuminate\Contracts\Auth\Authenticatable;

final class ClientAppParser
{
    private $verifier;

    private $repository;

    public function __construct(TokenVerifier $verifier, ClientAppRepository $repository)
    {
        $this->verifier = $verifier;
        $this->repository = $repository;
    }

    public function parse(string $token): Authenticatable
    {
        $payload = $this->verifier->verify($token);

        return $this->repository->find($payload);
    }
}
