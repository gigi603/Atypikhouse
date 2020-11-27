<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    protected $table = 'houses';

    public function admin() {
        return $this->belongsTo('App\Admin');
    }
    
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment')->orderBy('id', 'DESC');
    }

    public function children()
    {
           return $this->hasMany('App\Comment', 'parent_id')->orderBy('id', 'DESC');
    }

    public function reservations() {
        return $this->belongsTo('App\Reservation');
    }

    public function proprietes() {
        return $this->hasMany('App\Propriete', 'category_id');
    }
    

    public function valuecatproprietes() {
        return $this->hasMany('App\Valuecatpropriete', 'house_id');
    }
}
