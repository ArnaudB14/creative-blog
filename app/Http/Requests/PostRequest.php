<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'max:255'],
            'description' => ['required'],
            'file_path' => ['nullable', 'max:2048', 'mimes:jpg,png,jpeg,bpm,svg'],
            'category_id' => ['required'],
            'status_id' => ['required']
        ];
    }

}
