<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class MillingDurationFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'mill_start'=>'nullable|date_format:"m/d/Y"',
            'mill_end'=>'nullable|date_format:"m/d/Y"',
            'crop_length'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
