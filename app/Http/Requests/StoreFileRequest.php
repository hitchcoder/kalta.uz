<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFileRequest extends FormRequest
{
    /**
     * Maximum upload size, in kilobytes.
     */
    public const MAX_FILE_SIZE_KB = 25 * 1024;

    /**
     * Extensions allowed for upload. Kept to common, non-executable
     * document/media/archive types to reduce the risk of hosting
     * malicious payloads (scripts, HTML, etc.) via the file-sharing flow.
     */
    public const ALLOWED_EXTENSIONS = [
        'jpg', 'jpeg', 'png', 'gif', 'webp', 'svg',
        'pdf', 'txt', 'csv', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx',
        'zip', 'rar', '7z',
        'mp3', 'wav', 'mp4', 'mov', 'avi',
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
                'max:'.self::MAX_FILE_SIZE_KB,
                'mimes:'.implode(',', self::ALLOWED_EXTENSIONS),
            ],
        ];
    }
}
