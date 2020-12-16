<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class CapUtilizationFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'normal_rate_cap'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'tonnes_cane_per_hr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'ave_hr_actual_grinding'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'cap_utilization'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'mechanical_time_eff'=>'nullable|numeric|regex:/^\d*(\.\d{2})?$/',

        ];

    }




}
