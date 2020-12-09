<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class PRDNIncrementFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'current_cy_prod'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'past_cy_prod'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'increase_decrease'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'sharing_ratio'=>'nullable|string|max:255',

        ];

    }




}
