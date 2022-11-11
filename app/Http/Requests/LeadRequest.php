<?php

namespace App\Http\Requests;

use App\Exceptions\ValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Tymon\JWTAuth\Facades\JWTAuth;

class LeadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return JWTAuth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:leads,name',
            'source' => 'required|string',
            'owner' => 'required|string',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new ValidationException($validator);
    }
}
