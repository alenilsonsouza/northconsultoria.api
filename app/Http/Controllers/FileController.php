<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\File;

class FileController extends Controller
{
    public function insert(Request $request)
    {
        $array = ['error' => ''];

        $validator = Validator::make($request->all(), [
            'id_people' => 'required|integer',
            'file' => 'required|file',
            'type' => 'required'
        ]);

        if (!$validator->fails()) {

            $file = $request->file('file');
            $path = $file->store('public/storage/');
            $path = explode('/', $path);

            $new = new File();
            $new->id_people = $request->id_people;
            $new->name = end($path);
            $new->type = $request->input('type');
            $new->date_register = date('Y-m-d');
            $new->save();
        } else {
            $array['error'] = $validator->errors()->first();
            return $array;
        }

        return $array;
    }
}
