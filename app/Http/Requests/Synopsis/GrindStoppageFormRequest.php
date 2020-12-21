<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class GrindStoppageFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'actual_grind_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'actual_grind_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'total_delays_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'total_delays_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
