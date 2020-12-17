<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class OARFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'actual_oar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'standard_oar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'reduced_oar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            
        ];

    }




}
