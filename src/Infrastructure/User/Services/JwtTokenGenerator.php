<?php

namespace ProfessorGradingApp\Infrastructure\User\Services;

use Carbon\CarbonImmutable;
use Firebase\JWT\JWT;
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;
use ProfessorGradingApp\Domain\User\Contracts\JwtTokenGenerator as JwtTokenGeneratorInterface;
use ProfessorGradingApp\Domain\User\User;

/**
 * Class JwtTokenGenerator
 *
 * @package ProfessorGradingApp\Infrastructure\User\Services
 */
final class JwtTokenGenerator implements JwtTokenGeneratorInterface
{
    private const algorithm = 'HS256';

    /**
     * @inheritdoc
     */
    public function generate(User $User): string
    {
        $today = CarbonImmutable::now();

        $time = $today->getTimestamp();

        $expireAt = $today->addMinutes(config('jwt.expire'))->getTimestamp();

        $claims = [
            'sub' => (string) $User->id(),
            'jti' => Uuid::generateUuid4(),
            'iss' => config('jwt.iss'),
            'aud' => config('jwt.aud'),
            'iat' => $time,
            'nbf' => $time,
            'exp' => $expireAt,
            'user' => [
                'id' => (string) $User->id(),
                'email' => (string) $User->email(),
                'role' => $User->role()->value(),
            ],
        ];

        return JWT::encode(
            $claims,
            config('jwt.secret'),
            self::algorithm
        );
    }
}
