<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, regardless of declared mime type,
     * since serving them back could lead to code execution or XSS on download.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar',
        'exe', 'sh', 'bat', 'cmd', 'com', 'msi', 'dll',
        'js', 'mjs', 'jar', 'py', 'rb', 'pl', 'cgi',
        'asp', 'aspx', 'jsp', 'htaccess', 'htpasswd',
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
                'max:51200', // 50MB
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('This file type is not allowed.');
                    }
                },
            ],
        ];
    }
}
