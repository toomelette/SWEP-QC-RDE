<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class TenYrAgriParamFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'crop_year_id'=>'required|string|max:11',
            'area_harvested'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'tc_ha'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'lkg_tc'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'lkg_ha'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
