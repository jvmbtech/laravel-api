<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends FormRequest
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
        return [
            'name' => 'required|max:255',
            'email' => 'required|email:rfc',
            'password' => 'required|max:255',
            'cpf' => 'required|size:11',
            'phone' => 'nullable|max:20',
            'cellphone' => 'nullable|max:20',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'O parâmetro :attribute é obrigatório',
            'max' => 'O parâmetro :attribute informado é muito longo',
            'cpf.size' => 'O campo CPF deve conter 11 caracteres numéricos',
            'email' => 'Informe um email válido'
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'error_message' => $validator->errors(),
            ], 422)
        );
    }
}
