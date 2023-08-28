<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $cat_id = $this->route('productcategories.update')->categoryId;
        return [
            'catgeoryName' => 'required|string|max:255',
            'categoryDetail' => 'nullable|string',
            'categoryAbb' => 'required|string|max:5',
        ];
    }
}
