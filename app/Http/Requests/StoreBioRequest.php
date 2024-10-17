<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBioRequest extends FormRequest
{
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
            'title' => ['required', 'string'],
            'avatar_icon' => ['nullable', 'image'],
            'telegram' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'instagram' => ['nullable', 'string', 'max:255'],
            'twitter' => ['nullable', 'string', 'max:255'],
            'github' => ['nullable', 'string', 'max:255'],
            'blog' => ['nullable', 'string', 'max:255'],
            'cover_url' => ['nullable', 'string', 'max:255'],
        ];
    }

  /**
     * Get the validated data with the avatar icon path if uploaded.
     *
     * @param  string|null  $key
     * @param  mixed|null  $default
     * @return array
     */
    public function validated($key = null, $default = null): array
    {
        $data = parent::validated($key, $default);
        if ($this->hasFile('avatar_icon')) {
            $imageName = time() . '_' . $this->avatar_icon->getClientOriginalName();
            $this->avatar_icon->move(public_path('images'), $imageName);
            $data['avatar_icon'] = 'images/' . $imageName;
        }
        unset($data['description']);
        return $data;
    }
}
