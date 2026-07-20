<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\UploadedFile;

class StoreKaltaRequest extends FormRequest
{
    /**
     * Extensions that must never be served back from public storage.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar', 'pht',
        'exe', 'sh', 'bat', 'cmd', 'cgi', 'pl', 'asp', 'aspx', 'jsp',
        'htaccess', 'htpasswd',
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
                'max:51200', // 50MB
                function ($attribute, UploadedFile $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('This file type is not allowed for security reasons.');
                    }
                },
            ],
        ];
    }
}
