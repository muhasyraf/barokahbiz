<?php

namespace App\Http\Requests;

use App\Models\BukuBesar;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBukuBesarRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('buku_besar_edit');
    }

    public function rules()
    {
        return [
            'tanggal' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'akun_id' => [
                'required',
                'integer',
            ],
            'keterangan' => [
                'string',
                'nullable',
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
