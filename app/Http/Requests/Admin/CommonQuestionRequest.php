<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CommonQuestionRequest extends BaseAdminRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $validation = 'required|string';
        return [
            'question_ar' => $validation,
            'question_en' => $validation,
            'answer_ar' => $validation,
            'answer_en' => $validation,
        ];
    }
}
