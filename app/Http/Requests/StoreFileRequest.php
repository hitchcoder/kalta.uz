<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Extensions that must never be accepted, even if the MIME type looks safe,
     * to avoid uploads that could be executed server-side or in the browser.
     */
    private const BLOCKED_EXTENSIONS = [
        'php', 'php3', 'php4', 'php5', 'php7', 'phtml', 'phar',
        'exe', 'bat', 'cmd', 'sh', 'bash', 'com', 'msi',
        'js', 'jar', 'py', 'pl', 'cgi', 'asp', 'aspx', 'jsp',
        'htaccess', 'htm', 'html', 'svg',
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
                'max:' . config('kalta.uploads.max_kilobytes', 20480),
                function (string $attribute, $value, \Closure $fail) {
                    $extension = strtolower($value->getClientOriginalExtension());

                    if (in_array($extension, self::BLOCKED_EXTENSIONS, true)) {
                        $fail('Files with the .' . $extension . ' extension are not allowed.');
                    }
                },
            ],
        ];
    }
}
