<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, even if the client spoofs
     * the mime type, since a misconfigured web server could execute them.
     */
    protected const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'pht',
        'exe', 'msi', 'bat', 'cmd', 'com', 'scr', 'dll', 'so',
        'sh', 'bash', 'cgi', 'pl', 'ps1', 'vbs', 'jar',
    ];

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
                'max:102400',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('Files with the extension ".'.$extension.'" are not allowed.');
                    }
                },
            ],
        ];
    }
}
