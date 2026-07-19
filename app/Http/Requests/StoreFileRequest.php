<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, since uploads are stored
     * under the public disk and could be executed if served directly
     * by a misconfigured web server.
     */
    private const FORBIDDEN_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'pht', 'phar',
        'exe', 'sh', 'bat', 'cmd', 'cgi', 'pl', 'py', 'rb',
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
                'max:20480', // 20 MB
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (in_array($extension, self::FORBIDDEN_EXTENSIONS, true)) {
                        $fail('This file type is not allowed for security reasons.');
                    }
                },
            ],
        ];
    }
}
