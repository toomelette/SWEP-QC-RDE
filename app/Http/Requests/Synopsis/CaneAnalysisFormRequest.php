<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class CaneAnalysisFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'percent_pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_sucrose'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_fiber'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_trash'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'pol_percent_fiber'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',

        ];

    }




}
