<?php

declare(strict_types=1);

namespace App\Actions\Plateau;

use App\Http\Resources\Plateau\JWTResource;
use Illuminate\Support\Str;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\Token\Plain;

final class JWTGenerator
{
    public function embed(): JWTResource
    {
        return new JWTResource($this->generate([
            'tableau:views:embed',
        ]));
    }

    /** @param string[] $scp */
    private function generate(array $scp): Plain
    {
        return (new Builder(new JoseEncoder(), ChainedFormatter::default()))
            ->withHeader('iss', config('tableau.client_id'))
            ->withHeader('kid', config('tableau.access_key'))
            ->identifiedBy((string) Str::uuid())
            ->permittedFor('tableau')
            ->relatedTo(config('tableau.user_name'))
            ->withClaim('scp', $scp)
            ->issuedBy(config('tableau.client_id'))
            ->issuedAt(now()->toDateTimeImmutable())
            ->expiresAt(now()->addMinutes(config('tableau.token_cache_time'))->toDateTimeImmutable())
            ->getToken(
                new Sha256(),
                InMemory::plainText(config('tableau.access_secret')),
            );
    }
}
