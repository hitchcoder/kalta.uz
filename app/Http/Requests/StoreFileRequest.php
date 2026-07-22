<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be executed if served back from storage.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'php7', 'phar', 'pht',
        'exe', 'bat', 'cmd', 'sh', 'bash', 'com', 'msi',
        'js', 'jar', 'py', 'pl', 'cgi', 'asp', 'aspx', 'jsp', 'htaccess',
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
                'max:' . config('kalta.max_upload_kb', 20480),
                function ($attribute, $value, $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('Files of this type are not allowed.');
                    }
                },
            ],
        ];
    }
}
