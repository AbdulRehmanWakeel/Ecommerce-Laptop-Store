<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariantRequest extends FormRequest
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
        $variantId = $this->route('variant')?->id ?? null;

        return [
            'sku' => 'nullable|string|max:255|unique:variants,sku,' . $variantId,
            'processor' => 'required|string|max:255',
            'ram' => 'required|string|max:255',
            'storage' => 'required|string|max:255',
            'graphics_card' => 'nullable|string|max:255',
            'display_size' => 'required|string|max:255',
            'resolution' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ];
    }
}
