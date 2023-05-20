<?php

namespace App\Http\Requests\Lots;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3'],
            'start_price' => ['required', 'numeric', 'gt:0'],
            'end_date' => ['required', 'date', 'date_format:Y-m-d H:i:s', 'after:now'],
        ];
    }
}
