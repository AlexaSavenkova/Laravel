<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'tel'  => ['nullable', 'string'],
            'email' => ['required'],
            'info' => ['required', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'имя'
        ];
    }
}
