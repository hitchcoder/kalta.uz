<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaltaRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, regardless of declared mime type,
     * since they can be executed server-side or by a browser if served back.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'phar',
        'exe', 'bat', 'cmd', 'sh', 'bash', 'ps1', 'msi', 'com',
        'js', 'mjs', 'jar', 'py', 'rb', 'pl', 'cgi', 'htaccess', 'asp', 'aspx', 'jsp',
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
                'max:20480', // 20MB
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
