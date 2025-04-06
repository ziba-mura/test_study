<?php

namespace App\Http\Controllers\Student\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use domain\Student\Enum\Grade;

// 生徒登録用リクエスト
class AddRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:10'],
            'hobby' => ['nullable', 'string', 'max:100'],
            'grade' => ['required',  new Enum(Grade::class)],
        ];
    }

    public function getName(): string
    {
        return $this->string('name');
    }

    public function getHobby(): string
    {
        return $this->string('hobby');
    }

    public function getGrade(): Grade
    {
        return Grade::from($this->integer('grade'));
    }
}
