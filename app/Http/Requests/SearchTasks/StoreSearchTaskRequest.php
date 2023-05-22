<?php

namespace App\Http\Requests\SearchTasks;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Closure;

class StoreSearchTaskRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required:string',
            'age_from' => 'integer|min:14|max:80',
            'age_to' => 'integer|min:14|max:80',
            'birth_day' => 'date_format:j',
            'birth_month' => 'date_format:n',
            'birth_year' => [
                'date_format:Y',
                'after:1901',
                function (string $attribute, mixed $value, Closure $fail) {
                    if (now()->year - intval($value) < 14) {
                        $fail('Пользователю ВК не может быть менее 14 лет.');
                    }
                }
            ],
            'city' => 'integer|min:1',
            'university' => 'integer|min:1',
            'university_year' => 'date_format:o|before:2031|after:1945',
            'university_faculty' => 'integer|min:1',
            'university_chair' => 'integer|min:1',
            'sex' => 'integer|min:0|max:2',
            'status' => 'integer|min:1|max:8',
            'has_photo' => 'boolean',
            'keywords' => 'required|array',
            'keywords.*' => 'string',
        ];
    }
}
