<?php

namespace App\Http\Requests;

use App\Domain\FormStringLimit;
use Illuminate\Foundation\Http\FormRequest;

class NoteRequest extends FormRequest
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
            'title' => 'required|max:' . FormStringLimit::VARCHAR_COLUMN_LIMIT,
            'body' => '',
        ];
    }

    public function messages()
    {
        return [
            'title.max' => 'タイトルは' . FormStringLimit::VARCHAR_COLUMN_LIMIT . '文字以下で入力してください。',
        ];
    }


    public function prepareForValidation()
    {
        if (!isset($this->title)) {
            $this->merge(['title' => '無題']);
        }
    }
}
