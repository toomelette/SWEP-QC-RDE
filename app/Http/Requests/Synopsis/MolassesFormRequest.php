<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class MolassesFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'tonnes_manufactured'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'tonnes_due_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_on_cane'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'brix'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'apparent_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'gravity_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_ash'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'percent_reducing_sugar'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'expected_molasses_purity'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
