<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Maximum allowed upload size, in kilobytes.
     */
    private const MAX_FILE_SIZE_KB = 51200; // 50 MB

    /**
     * Extensions that must never be stored, since serving them back
     * could lead to code execution or other abuse.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar',
        'exe', 'sh', 'bat', 'cmd', 'com', 'msi', 'dll', 'jar',
        'py', 'pl', 'cgi', 'js',
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
                'max:' . self::MAX_FILE_SIZE_KB,
                function ($attribute, $value, $fail) {
                    $extension = strtolower((string) $value->getClientOriginalExtension());

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('This file type is not allowed for security reasons.');
                    }
                },
            ],
        ];
    }
}
