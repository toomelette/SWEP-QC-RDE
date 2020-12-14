<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class FirstExpressedJuiceFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'brix'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'apparent_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'decrease_in_ap'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
