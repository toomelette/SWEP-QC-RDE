<?php

namespace App\Http\Requests\Trader;

use Illuminate\Foundation\Http\FormRequest;

class TraderFilterRequest extends FormRequest{



    public function authorize(){
        return true;    
    }

    

    public function rules(){

        return [
            
            'q'=>'nullable|string|max:90',

        ];

    }




}
