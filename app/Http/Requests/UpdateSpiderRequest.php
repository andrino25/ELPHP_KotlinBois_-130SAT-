<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSpiderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'userID' => ['sometimes', 'exists:users,id'],
            'spiderName' => ['sometimes', 'string', 'max:255'],
            'spiderSize' => ['sometimes', 'in:Small,Medium,Large'],
            'spiderHealthStatus' => ['sometimes', 'in:Healthy,Sick,Critical'],
            'spiderCostPrice' => ['sometimes', 'numeric', 'min:0'],
        ];
    }
}
