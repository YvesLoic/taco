<?php

namespace App\Http\Requests;

use App\Http\Helper\ApiResponse;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DisplacementRequest extends FormRequest
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
            'to' => 'required|string',
            'to_lat' => 'required',
            'to_lon' => 'required',
            'from' => 'required|string',
            'from_lat' => 'required',
            'from_lon' => 'required',
            'distance' => 'required',
            'price' => 'numeric|min:0',
            'status' => 'in:pending,ongoing,ended,broadcasting|string',
            'type' => 'in:depot,course,voyage|string',
            'car_id' => 'numeric',
            'user_id' => 'required|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            ApiResponse::error(400, $validator->errors())
        );
    }
}
