<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsaasController extends Controller
{
    public function storageAsaas(Request $request) {

        $header = $request->header('User-Agent');

        if($header == 'Java/1.8.0_275') {

        }
        $response = $request->input('event');
        print_r($response);
        echo '<br />'.$header;

        exit;
    }
}
