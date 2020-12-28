<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class TenYrPrdnFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'crop_year_id'=>'required|string|max:11',
            'gross_cane_milled'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'raw_sugar_man'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'molasses_due_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'bagasse'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'filter_cake'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
