<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PembeliRequest extends FormRequest
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
        if ($this->isMethod('put')) {
            return [
				'nama_pembeli' => ["required"],
				'alamat' => ["required"],
				'email' => ["required"],
				'no_telp' => ["required"],

            ];
        }
        return [
			'nama_pembeli' => ["required"],
			'alamat' => ["required"],
			'email' => ["required"],
			'no_telp' => ["required"],

        ];
    }
}
