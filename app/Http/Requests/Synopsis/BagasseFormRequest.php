<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class BagasseFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'tonnes'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_on_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_moisture'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_fiber'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'calorific_value'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
