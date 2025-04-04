<?php

namespace App\Http\Controllers\Student\Request;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use domain\Entity\Student\Enum\Grade;

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
            'name' => ['required', 'string', 'max:255'],
            'hobby' => ['nullable', 'string'],
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
