<?php

namespace App\Modules\Mutasi\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMutasiRequest extends FormRequest
{
    /**
     * Determine if the Mutasi is authorized to make this request.
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
            
        ];
    }
}
