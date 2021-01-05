<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class TenYrRatioYieldFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'crop_year_id'=>'required|string|max:11',
            'imbibition_fiber_ratio'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'rendement'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'quality_ratio'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'kg_mollasses_per_ton_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'kg_bagasse_per_ton_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'kg_fc_per_ton_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
