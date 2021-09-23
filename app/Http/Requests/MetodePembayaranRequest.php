<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MetodePembayaranRequest extends FormRequest
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
				'nama_metode' => ["required"],
				'no_rekening' => ["required"],
				'atas_nama' => ["required"],

            ];
        }
        return [
			'nama_metode' => ["required"],
			'no_rekening' => ["required"],
			'atas_nama' => ["required"],

        ];
    }
}
