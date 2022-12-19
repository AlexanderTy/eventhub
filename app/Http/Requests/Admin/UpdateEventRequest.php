<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'title'           => ['required', 'min:3'],
            'sale_start_date' => ['nullable','date_format:Y-m-d'],
            'sale_start_time' => ['nullable','date_format:H:i'],
            'sale_end_date'   => ['nullable','date_format:Y-m-d'],
            'sale_end_time'   => ['nullable','date_format:H:i'],
            'public'          => ['boolean'],
            'image'           => ['nullable'],
            'dates' => 'array|nullable',
            'dates.*.id' => 'nullable',
            'dates.*.event_id' => 'integer|nullable',
            'dates.*.status' => 'nullable',
            'dates.*.label' => 'nullable',
            'dates.*.note' => 'nullable',
            'dates.*.venue_id' => 'nullable',
            'dates.*.duration' => 'nullable',
            'dates.*.release_date' => 'nullable',
            'slug' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }
}
