<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class BHRFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'actual_bhr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'theoritical_bhr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'basic_bhr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'reduced_bhr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
        ];

    }




}
