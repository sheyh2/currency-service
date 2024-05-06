<?php

namespace App\Http\Resources\Currency;

use App\Core\ApiKeys;
use Domain\Currency\Entities\Currency;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Currency
 */
class ShowResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            ApiKeys::ID->value => $this->getId(),
            ApiKeys::NAME->value => $this->getName(),
            ApiKeys::RATE->value => $this->getRate(),
        ];
    }
}
