<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class BHLossFormRequest extends FormRequest{


    

    public function authorize(){
        return true;
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'milling_loss'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'bagasse'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'filter_cake'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'molasses'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'undetermined'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'total'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
        ];

    }




}
