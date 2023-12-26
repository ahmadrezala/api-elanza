<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
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



     public function failedValidation(Validator $validator)
     {
        throw new HttpResponseException(response()->json([
          'status'    =>'error',
          'success'   => false,
          'message'   => 'Validation errors',
          'data'      => $validator->errors()
        ]));
     }




    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string',
            'c_password' => 'required|same:password',
        ];
    }
}
