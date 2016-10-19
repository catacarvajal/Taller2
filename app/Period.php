<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
	/**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'period';

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
    protected $fillable = ['id','year_init', 'year_end'];

}