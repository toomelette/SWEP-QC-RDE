<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class CaneSugarTonsFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'sgrcane_gross_tonnes'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'sgrcane_net_tonnes'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'rawsgr_tonnes_due_cane'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'rawsgr_tonnes_manufactured'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',
            'equivalent'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',

        ];

    }




}
