<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
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
                'name'=>'required|string|max:255',
                'email'=>'email|unique:users,email,'.$this->route('user'),
                'password'=>'nullable|string|min:8',
                'age'=>'required|integer',
                'type'=>'required|string|max:255',
                'salary'=>'nullable|numeric',
            ];

    }
}
