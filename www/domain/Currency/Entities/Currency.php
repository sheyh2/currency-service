<?php

namespace Domain\Currency\Entities;

use Domain\Currency\Builders\CurrencyBuilder;
use Illuminate\Database\Eloquent\Model;


/**
 * Class Currency.php
 * @package Domain\Currency\Entities
 *
 * @property int $id
 * @property string $name
 * @property double $rate
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $deleted_at
 *
 * @mixin CurrencyBuilder
 */
class Currency extends Model
{
    protected $table = 'currencies';
    protected $guarded = [];

    public function newEloquentBuilder($query): CurrencyBuilder
    {
        return new CurrencyBuilder($query);
    }

    // Getters

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updated_at;
    }
}
