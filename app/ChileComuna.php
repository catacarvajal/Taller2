<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Month extends Model
{
    //
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chilecomuna';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'gid';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['gid','join_count', 'perimeter', 'lacar2_id', 'cntcode', 'pcode', 'name2', 'cntname2', 'name3', 'sdcode', 'undecodeor', 'lacar2_', 'country_na', 'dcode', 'name1', 'join_cou_1', 'region', 'details', 're_count', 're_sum', 're_mean', 're2_count', 're2_sum', 're2_mean', 'datos_coun', 'datos_sum', 'datos_mean', 'elev_count', 'elev_sum', 'elev_mean', 'geom'];

}