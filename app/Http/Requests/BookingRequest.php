<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'type'  => 'required|in:table,event,menu',
            'name'  => 'required|min:3|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'date'  => 'required|date',
            'time'  => 'required',
            'people' => 'required|numeric',
            'file'  => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'messages' => 'nullable|min:3',
        ];
    }
}
