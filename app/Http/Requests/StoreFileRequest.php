<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be served back from the public disk,
     * since some web server configurations will execute them.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php2', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar', 'pht',
        'exe', 'sh', 'bat', 'cmd', 'msi', 'com', 'cgi', 'pl', 'py',
        'jsp', 'jspx', 'asp', 'aspx', 'htaccess', 'htpasswd', 'ini',
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
                'max:20480',
                function ($attribute, $value, $fail) {
                    $extension = strtolower((string) $value->getClientOriginalExtension());
                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('This file type is not allowed.');
                    }
                },
            ],
        ];
    }
}
