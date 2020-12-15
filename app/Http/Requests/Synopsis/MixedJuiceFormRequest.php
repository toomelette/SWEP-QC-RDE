<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class MixedJuiceFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'tonnes'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_on_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'brix'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'apparent_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_sucrose'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'gravity_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
