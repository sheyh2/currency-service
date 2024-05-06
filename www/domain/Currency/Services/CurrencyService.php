<?php

namespace Domain\Currency\Services;

use App\Core\Services;
use Domain\Currency\Entities\Currency;

class CurrencyService extends Services
{
    private Currency $currency;

    public function __construct(Currency $currency)
    {
        parent::__construct();

        $this->currency = $currency;
    }

    public function importCurrencies()
    {
        $apiUrl = 'https://www.cbr.ru/scripts/XML_daily.asp';
        $items = file_get_contents($apiUrl);
        $items = new \SimpleXMLElement($items);
        $items = json_decode(json_encode($items), true);
        $items = collect($items['Valute']);

        $items = $items->transform(function ($item){
            return [
                'name' => $item['Name'],
                'rate' => floatval(str_replace(',', '.', $item['VunitRate'])),
            ];
        })->toArray();

        $this->currency->insert($items);
    }
}
