<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreWorkTransactionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'worker_id' => 'required|exists:workers,id',
            'hours' => 'required|integer|min:1',
            'is_paid' => 'required|boolean',
        ];
    }
}
