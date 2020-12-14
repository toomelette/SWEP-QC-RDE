<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class SugarAnalysisFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'gravity_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'apparent_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_sucrose'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_moisture'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'di'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'clarity_turbidity'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'precent_ash'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',

        ];

    }




}
