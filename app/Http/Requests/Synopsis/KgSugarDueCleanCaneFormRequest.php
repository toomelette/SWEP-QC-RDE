<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class KgSugarDueCleanCaneFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'trash_percent_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_recovery'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'recoverable'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            
        ];

    }




}
