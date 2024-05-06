<?php

namespace App\Http\Resources\Currency;

use App\Core\ApiKeys;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class IndexCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return $this->collection->transform(function($item)
        {
            return [
                ApiKeys::ID->value => $item->getId(),
                ApiKeys::NAME->value => $item->getName(),
                ApiKeys::RATE->value => $item->getRate(),
            ];
        })->toArray();
    }
}
