<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;


class UserController extends Controller
{
    public function getList() {
        $array = ['error' => ''];

        $user = Auth::user();

        $users = User::where('id','!=',$user->id)->orderBy('id', 'DESC')->get();

        if($users) {
            
            $array['list'] = $users;
        }

        return $array;
    }

    public function getOne() {
        $array = ['error' => ''];

        $user = Auth::user();

        $item = User::where('id', $user->id)->first();

        $array['list'] = $item;

        return $array;
    }

    public function insert(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(!$validator->fails()) {

            $password = password_hash($request->password, PASSWORD_DEFAULT);

            $new = new User();
            $new->name = $request->name;
            $new->email = $request->email;
            $new->password = $password;
            $new->save();

        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }

    public function update(Request $request, $id) {
        $array = ['error' => ''];

        $item = User::find($id);

        if($item) {
            $validator = Validator::make($request->all(),[
                'name' => 'required',
                'email' => 'required|email',
                'password' => ''
            ]);
    
            if(!$validator->fails()) {

                $item->name = $request->name;
                $item->email = $request->email;
                if($request->password) {
                    $password = password_hash($request->password, PASSWORD_DEFAULT);
                    $item->password = $password;
                }
                
                $item->save();
    
            } else {
                $array['error'] = $validator->errors()->first();
                return $array;
            }
        }
        return $array;
    }

    public function delete($id) {
        $array = ['error' => ''];

        $item = User::where('id', $id)->get();

        if($item) {
            User::where('id', $id)->delete();
        } else {
            $array['error'] = "Item não encontrado!";
            return $array;
        }

        return $array;
    }
}
