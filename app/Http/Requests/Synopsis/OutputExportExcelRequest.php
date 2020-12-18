<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class OutputExportExcelRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'cy_id'=>'nullable|string|max:11',
            'cy_name'=>'nullable|string|max:255',
            'cat'=>'nullable|int|max:30',

        ];

    }




}
