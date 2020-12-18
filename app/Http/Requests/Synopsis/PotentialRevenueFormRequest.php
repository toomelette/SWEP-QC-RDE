<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class PotentialRevenueFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'due_bh'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'due_trash'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'total'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',
            'potential_revenue'=>'nullable|numeric|regex:/^\d*(\.\d{1,2})?$/',

        ];

    }




}
