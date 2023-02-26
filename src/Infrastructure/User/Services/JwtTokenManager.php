<?php

namespace ProfessorGradingApp\Infrastructure\User\Services;

use Carbon\CarbonImmutable;
use Firebase\JWT\{JWT, Key};
use ProfessorGradingApp\Domain\Common\ValueObjects\Uuid;
use ProfessorGradingApp\Domain\User\Contracts\JwtTokenManager as JwtTokenManagerInterface;
use ProfessorGradingApp\Domain\User\Exceptions\InvalidToken;
use ProfessorGradingApp\Domain\User\User;

/**
 * Class JwtTokenManager
 *
 * @package ProfessorGradingApp\Infrastructure\User\Services
 */
final class JwtTokenManager implements JwtTokenManagerInterface
{
    private const ALGORITHM = 'HS256';

    /**
     * @inheritdoc
     */
    public function generate(User $User): string
    {
        $today = CarbonImmutable::now();

        $time = $today->getTimestamp();

        $expireAt = $today->addMinutes(config('jwt.exp'))->getTimestamp();

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
            self::ALGORITHM
        );
    }

    /**
     * @inheritdoc
     * @throws InvalidToken
     */
    public function decode(string $token): array
    {
        try {

            return (array) JWT::decode(
                $token,
                new Key(config('jwt.secret'), self::ALGORITHM),
            );

        } catch (\Exception $exception) {

            //TODO: manage errors message according to the error type
            throw new InvalidToken($exception->getMessage());
        }
    }
}
