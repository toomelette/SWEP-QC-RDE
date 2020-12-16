<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynMillingPlant extends Model{



    use Sortable;

    protected $table = 'syn_milling_plant';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'milling_plant_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'extraction_equipment' => '',
        'imbibition_percent_fiber' => 0.00000,
        'imbibition_percent_cane' => 0.00000,
        'pol' => 0.00000,
        'sucrose' => 0.00000,
        'reduced' => 0.00000,
        'whole_reduced' => 0.00000,
        'created_at' => null,
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',

    ];




    /** RELATIONSHIPS **/
    public function cropYear() {
    	return $this->belongsTo('App\Models\CropYear','crop_year_id','crop_year_id');
   	}


    public function mill() {
        return $this->belongsTo('App\Models\Mill','mill_id','mill_id');
    }


    
}
