<?php

namespace App\Http\Requests;

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
            'sale_start_date' => ['date_format:Y-m-d'],
            'sale_start_time' => ['date_format:H:i'],
            'sale_end_date'   => ['date_format:Y-m-d'],
            'sale_end_time'   => ['date_format:H:i'],
            'dates' => 'array',
            'dates.*.id' => 'required',
            'dates.*.event_id' => 'integer',
            'dates.*.status' => 'required',
            'dates.*.label' => '',
            'dates.*.note' => '',
            'dates.*.venue_id' => '',




        ];
    }
}
