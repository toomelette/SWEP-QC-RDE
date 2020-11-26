<?php

namespace App\Http\Requests\Synopsis;

use Illuminate\Foundation\Http\FormRequest;

class CaneSugarTonsFormRequest extends FormRequest{


    

    public function authorize(){

        return true;
    
    }

    


    public function rules(){

        return [
            
            'mill_id'=>'required|string|max:11',
            'crop_year_id'=>'required|string|max:11',
            'sgrcane_gross_tonnes'=>'nullable|string|max:23|regex:/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/',
            'sgrcane_net_tonnes'=>'nullable|string|max:23|regex:/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/',
            'rawsgr_tonnes_due_cane'=>'nullable|string|max:23|regex:/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/',
            'rawsgr_tonnes_manufactured'=>'nullable|string|max:23|regex:/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/',
            'equivalent'=>'nullable|string|max:23|regex:/^[0-9]{1,3}(,[0-9]{3})*(\.[0-9]+)*$/',

        ];

    }




}
