<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_edit');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'required',
                'integer',
            ],
            'blog_title' => [
                'string',
                'required',
            ],
            'date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
        ];
    }
}