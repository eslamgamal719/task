<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'         => ['required', 'max:50'],
            'description'   => ['required'],
            'start_date'    => ['date', 'after_or_equal:tomorrow'],
            'type'          => ['in:free,paid'],
            'category_id'   => ['required', 'exists:categories,id'],
            'user_id'       => ['required', 'exists:users,id'],
        ];
    }
}
