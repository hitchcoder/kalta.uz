<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
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
            'file' => [
                'required',
                'file',
                'max:20480', // 20 MB, in kilobytes
                'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,rtf,zip,rar,7z,jpg,jpeg,png,gif,webp,svg,mp3,wav,mp4,mov,avi,mkv',
            ],
        ];
    }
}
