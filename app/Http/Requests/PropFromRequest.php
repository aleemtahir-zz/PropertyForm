<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PropFromRequest extends FormRequest
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
        return [
            'property.name'     =>'required',
            'property.lot_no'   =>'required|numeric'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'property.name.required'   => '*Development Name is a required field',
            'property.lot_no.required'      => '*Lot No. is a required field',
            'property.lot_no.numeric'       => '*Lot No. no must be a number'
        ];
    }
}
