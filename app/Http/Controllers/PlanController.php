<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Plan;

class PlanController extends Controller
{
    public function getOne($id) {
        $array = ['error' => '', 'list'=>[]];

        $item = Plan::where('id', $id)->first();

        if($item) {
            $item['valor_real'] = 'R$ '.number_format($item['price'],2,',','.');
            $array['list'] = $item;
        }

        return $array;
    }
}
