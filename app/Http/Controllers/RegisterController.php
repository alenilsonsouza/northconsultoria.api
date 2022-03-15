<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\{
    People,
    
};

class RegisterController extends Controller
{
    public function insert(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'name' => 'required|min:3',
            'mother_name' => 'required|min:3',
            'birthdate' => 'required|date',
            'cpf' => 'required|unique:n_people,cpf',
            'sexo' => 'required',
            'type_register' => 'required'
        ]);

        if(!$validator->fails()) {

            $new = new People();
            $new->id_people = $request->id_people;
            $new->id_plan = $request->id_plan;
            $new->name = $request->name;
            $new->mother_name = $request->mother_name;
            $new->email = $request->email;
            $new->tel_cel = $request->tel_cel;
            $new->tel_fix = $request->tel_fix;
            $new->birthdate = $request->birthdate;
            $new->cpf = $request->cpf;
            $new->rg = $request->rg;
            $new->from = $request->from;
            $new->sexo = $request->sexo;
            $new->marital_status = $request->marital_status;
            $new->type_register = $request->type_register;
            $new->kinship = $request->kinship;
            $new->date_register = date('Y-m-d');
            $new->save();

            $array['id'] = $new->id;
            return $array;

        } else {

            $array['error'] = $validator->errors()->first();
            return $array;

        }

        return $array;
    }

    public function getOne($id, $type) {

        $array = ['error' => ''];

        $item = People::where('id', $id)->where('type_register', $type)->first();

        if($item) {
            $array['list'] = $item;
        }

        return $array;
    }

    public function verifyCPF($cpf) {
        $array = ['response' => false];
        $item = People::select('cpf')->where('cpf', $cpf)->first();
        if($item) {
            $array['response'] = true;
        }
        return $array;
    }

    public function verifyEmail($email) {
        $array = ['response' => false];
        $item = People::select('email')->where('email', $email)->first();
        if($item) {
            $array['response'] = true;
        }
        return $array;
    }
}
