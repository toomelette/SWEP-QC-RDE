<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class DetailOfStoppageBFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'due_cleaning_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_cleaning_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_no_unavoidable_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_no_unavoidable_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_miscellaneous_hrs'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_miscellaneous_tet'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
