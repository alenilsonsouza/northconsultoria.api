<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Address;

class AddressController extends Controller
{
    public function insert(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'id_people' => 'required',
            'cep' => 'required',
            'logradouro' => 'required',
            'bairro' => 'required',
            'cidade' => 'required',
            'estado' => 'required'
        ]);

        if(!$validator->fails()) {

           $new = new Address();
           $new->id_people = $request->id_people;
           $new->cep = $request->cep;
           $new->logradouro = $request->logradouro;
           $new->numero = $request->numero;
           $new->complemento = $request->complemento;
           $new->bairro = $request->bairro;
           $new->cidade = $request->cidade;
           $new->estado = $request->estado; 
           $new->save();

        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }
}
