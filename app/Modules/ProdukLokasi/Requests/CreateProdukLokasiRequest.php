<?php

namespace App\Modules\ProdukLokasi\Requests;
use Illuminate\Foundation\Http\FormRequest;

class CreateProdukLokasiRequest extends FormRequest
{
    /**
     * Determine if the ProdukLokasi is authorized to make this request.
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
            'produk_id' => ['required', 'exists:produk,id'],
            'lokasi_id' => ['required', 'exists:lokasi,id'],
            'stok' => ['required', 'integer']
        ];
    }
}
