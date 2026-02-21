<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * دیاریکردنی ئایا بەکارهێنەر ڕێگەی پێدراوە ئەم داواکارییە بکات یان نا
     */
    public function authorize(): bool
    {
        // تەنها ئەگەر بەکارهێنەر چووبێتە ژوورەوە
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required', 
                'string', 
                'max:255',
                'min:2', // زیادکراو: کەمترین درێژی ناو
                'regex:/^[\p{L}\s\'-]+$/u', // زیادکراو: تەنها پیت، بۆشایی، هێفن
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     * پەیامە تایبەتیەکان بۆ هەڵەکانی validation
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // پەیامەکانی ناو
            'name.required' => 'ناوت تێبکە',
            'name.string' => 'ناو دەبێت بە شێوەی پیت بێت',
            'name.max' => 'ناو دەبێت کەمتر بێت لە ٢٥٥ پیت',
            'name.min' => 'ناو دەبێت کەمتر نەبێت لە ٢ پیت',
            'name.regex' => 'ناو دەبێت تەنها پیتی کوردی یان عەرەبی بێت',
            
            // پەیامەکانی ئیمەیڵ
            'email.required' => 'ئیمەیڵت تێبکە',
            'email.string' => 'ئیمەیڵ دەبێت بە شێوەی پیت بێت',
            'email.lowercase' => 'ئیمەیڵ دەبێت بە پیتی بچووک بێت',
            'email.email' => 'ئیمەیڵەکەت ڕێز نییە (example@domain.com)',
            'email.max' => 'ئیمەیڵ دەبێت کەمتر بێت لە ٢٥٥ پیت',
            'email.unique' => 'ئەم ئیمەیڵە پێشتر تۆمارکراوە',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     * ناوە جوانەکان بۆ خانەکان
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'name' => 'ناو',
            'email' => 'ئیمەیڵ',
        ];
    }

    /**
     * Prepare the data for validation.
     * ئامادەکردنی داتا پێش validation
     */
    protected function prepareForValidation(): void
    {
        // پاککردنەوەی بۆشایی زیادە لە ناو
        if ($this->has('name')) {
            $this->merge([
                'name' => trim($this->name),
            ]);
        }

        // گۆڕینی ئیمەیڵ بۆ پیتی بچووک
        if ($this->has('email')) {
            $this->merge([
                'email' => strtolower(trim($this->email)),
            ]);
        }
    }

    /**
     * Handle a passed validation attempt.
     * ئەگەر validation سەرکەوتوو بوو
     */
    protected function passedValidation(): void
    {
        // دەتوانیت لۆگی تۆمار بکەیت یان کارێکی تر بکەیت
        // logger('Profile update validation passed for user: ' . $this->user()->id);
    }

    /**
     * Handle a failed validation attempt.
     * ئەگەر validation سەرکەوتوو نەبوو
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        // دەتوانیت پەیامی تایبەت زیاد بکەیت یان لۆگی هەڵە تۆمار بکەیت
        // logger('Profile update validation failed for user: ' . $this->user()->id);
        
        parent::failedValidation($validator);
    }
}