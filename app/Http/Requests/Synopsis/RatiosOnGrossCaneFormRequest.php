<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class RatiosOnGrossCaneFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'burnt_cane_percent'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'quality_ratio'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'rendement'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'total_sugar_recovered'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
