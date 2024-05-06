<?php

namespace App\Http\Controllers\Api;

use App\Core\ApiKeys;
use App\Http\Resources\Currency\IndexCollection;
use App\Http\Resources\Currency\ShowResource;
use Domain\Currency\Entities\Currency;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CurrencyController extends ApiController
{
    private Currency $currency;

    public function __construct(Currency $currency)
    {
        parent::__construct();

        $this->currency = $currency;
    }

    public function index(Request $request): JsonResponse
    {
        $currencies = $this->currency
            ->orderBy('id', 'desc')
            ->paginate($request->input('item_per_page') ?? 18);

        $this->setMeta([
            ApiKeys::META->value => [
                ApiKeys::PER_PAGE->value => $currencies->perPage(),
                ApiKeys::TOTAL->value => $currencies->total(),
                ApiKeys::CURRENT_PAGE->value => $currencies->currentPage(),
                ApiKeys::LAST_PAGE->value => $currencies->lastPage(),
            ],
        ]);

        return $this->composeJson(new IndexCollection($currencies));
    }

    public function show(int $id): JsonResponse
    {
        $currency = $this->currency
            ->whereId($id)
            ->first();

        if(is_null($currency)){
            $this->setCode(404);
            $this->setMessage('Currency not found');

            return $this->composeJson();
        }

        return $this->composeJson(new ShowResource($currency));
    }
}
