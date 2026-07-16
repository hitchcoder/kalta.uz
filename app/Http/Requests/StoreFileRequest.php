<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, even if disguised behind an
     * allowed MIME type, since a served upload could otherwise be executed
     * by the web server or a client browser.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'phar', 'php3', 'php4', 'php5', 'pht',
        'exe', 'sh', 'bat', 'cmd', 'msi', 'com',
        'js', 'jsx', 'mjs', 'py', 'rb', 'pl', 'cgi',
        'htaccess', 'htpasswd',
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
                'max:20480', // 20MB, in kilobytes
            ],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $file = $this->file('file');

            if (!$file) {
                return;
            }

            $extension = strtolower($file->getClientOriginalExtension());

            if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                $validator->errors()->add('file', 'This file type is not allowed.');
            }
        });
    }
}
