<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArtistRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'image'=> 'nullable',
            'description_short' => 'nullable|string',
            'description_long' => 'nullable|string',
            'link_facebook' => 'nullable|string',
            'link_instagram' => 'nullable|string',
            'link_youtube' => 'nullable|string',
            'link_spotify' => 'nullable|string',
            'link_website' => 'nullable|string',
            'link_press' => 'nullable|string',
        ];
    }
}
