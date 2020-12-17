<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class SynBHLoss extends Model{



    use Sortable;

    protected $table = 'syn_bh_losses';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;




    protected $attributes = [

        'slug' => '',
        'bh_loss_id' => '',
        'crop_year_id' => '',
        'mill_id' => '',
        'milling_loss' => 0.00000,
        'bagasse' => 0.00000,
        'filter_cake' => 0.00000,
        'molasses' => 0.00000,
        'undetermined' => 0.00000,
        'total' => 0.00000,
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
