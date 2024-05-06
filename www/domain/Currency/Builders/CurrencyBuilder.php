<?php

namespace Domain\Currency\Builders;

use App\Core\Builders;

class CurrencyBuilder extends Builders
{
    public function whereId(int $id): CurrencyBuilder
    {
        return $this->where('id', '=', $id);
    }
}
