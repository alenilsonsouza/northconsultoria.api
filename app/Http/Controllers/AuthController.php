<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class AuthController extends Controller
{
    public function unauthorized() {
        return response()->json([
            'error' => 'Não autorizado!'
        ], 401);
    }

    public function register(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'password_confirm' => 'required|same:password'
        ]);

        if(!$validator->fails()) {
            $name = $request->input('name');
            $email = $request->input('email');
            $password = $request->input('password');

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $newUser = new User();
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = $hash;
            $newUser->save();

            $array = $this->authHanler($email, $password, 'Ocorreu um erro.');

        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }

    public function login(Request $request) {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!$validator->fails()) {
            $email = $request->input('email');
            $password = $request->input('password');

            $array = $this->authHanler($email, $password, 'Usuário e/ou senha incorretos');

        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }

    public function validateToken() {
        $array = ['error'=>''];

        $user = Auth::user();
        $array['user'] = $user;

        return $array;
    }

    public function logout() {
        $array = ['error'=>''];
        Auth::logout();
        return $array;
    }

    private function authHanler($email, $password, $errorMessage) {

        $token = Auth::attempt([
            'email' => $email,
            'password' => $password
        ]);

        if(!$token) {
            $array['error'] = $errorMessage;
            return $array;
        }

        $array['token'] = $token;

        $user = Auth::user();

        $array['user'] = $user;

        return $array;
    }
}
