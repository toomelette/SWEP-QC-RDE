<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class TenYrFactoryPerformanceFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'crop_year_id'=>'required|string|max:11',
            'rated_capacity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'cap_utilization'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'pol_extraction'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'actual_bhr'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'reduced_overall_recovery'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'ave_num_of_grinding'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
