<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class MillingPlantFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'extraction_equipment'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'imbibition_percent_fiber'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'imbibition_percent_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'pol'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'sucrose'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'reduced'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'whole_reduced'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
