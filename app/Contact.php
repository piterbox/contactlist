<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'phone', 'date_birth', 'user_id'
    ];

    public function user(){
    	return $this->belongsTo('User');
    }
}
