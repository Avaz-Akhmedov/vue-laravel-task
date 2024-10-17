<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'products' => 'required|array',
            'products.*.name' => 'required|string',
            'products.*.count' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:1',
        ];
    }
}
