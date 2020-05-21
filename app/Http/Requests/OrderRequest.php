<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{   
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool true, em caso de duvidas!
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array com os campos e restricoes
     */
    public function rules()
    {
        return [
            'status' => 'required',
            'track_code' => 'required|min:5'
        ];
    }

    /**
     * Mensagens:
     * 
     * - O metodo messages() ira sobrescrever o da Request "original"
     * - Para cada validacao/restricao, definimos sua propria mensagem
     * @return array com as validacoes e mensagens
     */
    public function messages() 
    {
        return [
            'status.required' => 'Preencha o Status da ordem!',
            'track_code.required' => 'Preencha o Código de rastreamento!',
            'track_code.min' => 'O código deve ter no mínimo 5 caracteres!'
        ];
    }
}
