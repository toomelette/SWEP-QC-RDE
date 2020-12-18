<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class OutputFilterRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'cy'=>'nullable|string|max:11',
            'cat'=>'nullable|int|max:30',

        ];

    }




}
