<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class DetailOfStoppageAFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'due_factory_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_factory_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_no_cane_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_no_cane_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_transport_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_transport_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
