<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be served back from public storage,
     * since a misconfigured web server could execute them directly.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'pht', 'phar',
        'exe', 'sh', 'bat', 'cmd', 'msi', 'dll', 'jar', 'cgi', 'pl',
        'py', 'asp', 'aspx', 'jsp', 'htaccess', 'ini', 'com', 'vbs', 'ps1',
    ];

    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => [
                'required',
                'file',
                'max:51200', // 50 MB
                function ($attribute, $value, $fail) {
                    $extension = strtolower((string) $value->getClientOriginalExtension());

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('This file type is not allowed for security reasons.');
                    }
                },
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please choose a file to upload.',
            'file.max' => 'The file may not be larger than 50MB.',
        ];
    }
}
