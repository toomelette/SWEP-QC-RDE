<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class NonSugarFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'first_expressed_juice'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'last_expressed_juice'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'mixed_juice'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'syrup'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'molasses'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'sugar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
