<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermintaanRequest extends FormRequest
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
				'id_permintaan' => ["required"],
				'id_user' => ["required"],
				'jumlah_permintaan' => ["required"],

            ];
        }
        return [
			'id_permintaan' => ["required"],
			'id_user' => ["required"],
			'jumlah_permintaan' => ["required"],

        ];
    }
}
