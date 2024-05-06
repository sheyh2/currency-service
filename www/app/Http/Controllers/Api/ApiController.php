<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private int $code;
    private string $message;
    private array $meta;

    public function __construct()
    {
        app()->setLocale(\request()->header('x-language', 'ru'));

        $this->code = 200;
        $this->message = 'ok';
        $this->meta = [];
    }

    public function setCode(int $code): void
    {
        $this->code = $code;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function setMeta(array $meta): void
    {
        $this->meta = $meta;
    }

    public function composeJson($data = null): JsonResponse
    {
        return response()->json(
            array_merge([
                'language' => app()->getLocale(),
                'code' => $this->code,
                'message' => $this->message,
                'data' => $data,
            ], $this->meta),
            $this->code,
        );
    }
}
