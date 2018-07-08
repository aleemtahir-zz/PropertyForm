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
            'property.volume_no'  =>'required|numeric',
            'property.folio_no'   =>'required|numeric',
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
            'property.volume_no.required'   => 'Volume No. is a required field',
            'property.volume_no.numeric'    => 'Volume No. no must be a number',
            'property.volume_no.max:4'      => 'Volume No. may not be greater than 4',
            'property.folio_no.required'    => 'Folio No. is a required field',
            'property.folio_no.numeric'     => 'Folio No. no must be a number',
            'property.folio_no.max:4'       => 'Folio No. may not be greater than 4',
            'property.lot_no.required'      => 'Lot No. is a required field',
            'property.lot_no.numeric'       => 'Lot No. no must be a number'
        ];
    }
}
