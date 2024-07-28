<?php

namespace App\Http\Requests;

use App\Dto\Response\ApiResponseDto;
use App\Enums\StatusCodesEnum;
use App\Enums\SuccessEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class TodoCreateRequest extends FormRequest
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
            'description' => 'required|string|min:3|max:255',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->toJson();
        $response = new ApiResponseDto();
        $response->success = SuccessEnum::ERROR;
        $response->message = $errors;
        $response->statusCode = StatusCodesEnum::UNPROCESSABLE;

        throw new HttpResponseException(response()->json($response));
    }
}
