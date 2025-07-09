<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreAddressRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check(); // phải đăng nhập
    }

    public function rules()
    {
        return [
            'recipient_name' => 'required|string|max:100',
            'phone_number' => 'required|string|max:20',
            'province' => 'required|string|max:100',
            'district' => 'required|string|max:100',
            'ward' => 'required|string|max:100',
            'detailed_address' => 'required|string',
            'address_type' => 'in:Home,Office,Other',
            'is_default' => 'nullable|boolean',
        ];
    }
}

