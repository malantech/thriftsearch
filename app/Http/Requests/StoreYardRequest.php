<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreYardRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required|regex:/\b\d{5}\b/',
            'description' => ''
        ];
    }

    /**
     * return the message for the validation
     * {key}.{validation} => {message}
     * @return array
     */
    public function messages(){
        return [
            'name.required' => 'Please enter a name for your yard, this is what others will see.',
            'address.required' => 'It would be good to add an address so people can find the yard sale, just sayin\'.',
            'city.required' => 'Please enter a city',
            'state.required' => 'Please enter the state, we are not that smart yet but we\'are working on it',
            'zip.required' => 'A Zip is Key to let people know the general area and well, it\'s required so...',
            'zip.regex' => 'Are you sure that\'s the real zip code?'
        ];
    }
}
