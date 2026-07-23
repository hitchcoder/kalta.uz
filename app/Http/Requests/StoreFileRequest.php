<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions capable of server-side or browser execution; disallowed for a
     * generic file-sharing upload to prevent hosting/serving malicious payloads.
     */
    private const DISALLOWED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar',
        'exe', 'msi', 'dll', 'so', 'bat', 'cmd', 'com', 'sh', 'bash',
        'js', 'jsp', 'jspx', 'asp', 'aspx', 'cgi', 'pl', 'py',
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
                'max:51200',
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (in_array($extension, self::DISALLOWED_EXTENSIONS, true)) {
                        $fail('Files of this type are not allowed.');
                    }
                },
            ],
        ];
    }
}
