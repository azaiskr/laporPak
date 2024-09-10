<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;


class StoreReportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|max:255',
            'category_id' => 'required|in:1,2,3,4',
            'description' => 'required|max:255',
            'media' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'adress' => 'required|string|max:255',
            'status_id' => 'required|integer|in:1,2,3,4',
        ];
    }
}
