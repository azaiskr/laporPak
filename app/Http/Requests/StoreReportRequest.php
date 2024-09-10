<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;


class StoreReportRequest extends FormRequest
{

    public function authorize(): bool
    {
        return Auth::check() && User::find(Auth::id())->isUser();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'media' => 'required|string',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'adress' => 'required|string|max:255',
            'status_id' => 'nullable|exists:statuses,id',
        ];
    }
}
