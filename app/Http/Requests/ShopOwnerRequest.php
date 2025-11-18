<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShopOwnerRequest extends FormRequest
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
        // Get the ID of the current ShopOwner from the route (for update)
        $shopOwnerId = $this->route('shop_owner')?->id ?? null;

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:shop_owners,email,' . $shopOwnerId,
            'password' => $shopOwnerId ? 'nullable|string|min:6' : 'required|string|min:6',
            'shop_name' => 'required|string|max:255',
        ];
    }

    /**
     * Custom error messages for validation
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string'   => 'The name must be a string.',
            'name.max'      => 'The name may not be greater than 255 characters.',

            'email.required' => 'The email field is required.',
            'email.email'    => 'Please provide a valid email address.',
            'email.unique'   => 'This email is already taken by another shop owner.',

            'password.required' => 'The password field is required.',
            'password.string'   => 'Password must be a string.',
            'password.min'      => 'Password must be at least 6 characters.',

            'shop_name.required' => 'The shop name field is required.',
            'shop_name.string'   => 'The shop name must be a string.',
            'shop_name.max'      => 'The shop name may not be greater than 255 characters.',
        ];
    }
}
