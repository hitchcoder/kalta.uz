<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaltaRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, since the public storage
     * disk can be served directly by the web server.
     */
    protected array $disallowedExtensions = [
        'php', 'php3', 'php4', 'php5', 'phtml', 'phar',
        'exe', 'sh', 'bat', 'cmd', 'com', 'msi',
        'js', 'jar', 'py', 'rb', 'pl', 'cgi',
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
                'max:51200', // 50 MB
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());
                    if (in_array($extension, $this->disallowedExtensions, true)) {
                        $fail('This file type is not allowed.');
                    }
                },
            ],
        ];
    }
}
