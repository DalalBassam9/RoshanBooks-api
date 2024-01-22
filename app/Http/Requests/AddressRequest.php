<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'cityId' => 'required|integer|exists:cities,cityId',
            'district' => 'required|string',
            'phone' => 'nullable',
            'address' => 'required',
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'default' =>'nullable',

        ];

    }

  
}
