<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKaltaRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, even disguised behind another
     * declared mime type, since they can be executed by a web server or the
     * downloader's OS.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'phtml', 'php3', 'php4', 'php5', 'phar',
        'exe', 'msi', 'bat', 'cmd', 'sh', 'bash',
        'js', 'jar', 'com', 'scr', 'vbs', 'ps1', 'cgi',
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

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('Files with the .' . $extension . ' extension are not allowed.');
                    }
                },
            ],
        ];
    }
}
