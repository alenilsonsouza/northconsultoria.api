<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Lead;

class LeadController extends Controller
{
    public function insert(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'name' => '',
            'email' => 'required|email',
            'phone' => 'required',
            'interesse' => 'required'
        ]);

        if(!$validator->fails()) {

            $new = new Lead();
            $new->name = $request->name;
            $new->email = $request->email;
            $new->phone = $request->phone;
            $new->interesse = $request->interesse;
            $new->date_created = date('Y-m-d H:i:s');
            $new->save();

        } else {

            $array['error'] = $validator->errors()->first();
            return $array;

        }

        return $array;
    }

    public function getList(){

        $array = ['error' => ''];

        $list = Lead::orderBy('id', 'DESC')->get();

        foreach($list as $k => $v) {
            $list[$k]['date_formatted'] = date('d/m/Y H:i:s', strtotime($v['date_created']));
        }

        $array['data'] = $list;

        return $array;
    }
}
