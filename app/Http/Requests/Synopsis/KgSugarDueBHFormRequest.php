<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class KgSugarDueBHFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'standard_oar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'actual_oar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'additional_kg_sugar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            
        ];

    }




}
