<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DevForm extends FormRequest
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
            'developement.volume_no'  =>'required|numeric|max:4',
            'developement.folio_no'   =>'required|numeric|max:4'
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
            'developement.volume_no.required' => 'Volume No. is a required field',
            'developement.volume_no.numeric' => 'Volume No. no must be a number',
            'developement.volume_no.max:4' => 'Volume No. may not be greater than 4',
            'developement.folio_no.required' => 'Folio No. is a required field',
            'developement.folio_no.numeric' => 'Folio No. no must be a number',
            'developement.folio_no.max:4'  => 'Folio No. may not be greater than 4'
        ];
    }
}
