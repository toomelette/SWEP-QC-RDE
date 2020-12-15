<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class ClarificationFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'juice_apparent_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'juice_brix'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'juice_ph'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'juice_clarity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'lime_tonnes_used'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'lime_cao'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'lime_cao_per_tc'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
