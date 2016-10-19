<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'register';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['id','id_scenario', 'id_variable','id_period','id_month'];

}
