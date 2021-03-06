<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function admin() {
        return $this->belongsTo('App\Admin');
    }
    public function house() {
        return $this->belongsTo('App\House');
    }

    public function reservation() {
        return $this->belongsTo('App\Reservation');
    }

    public function children()
    {
           return $this->hasMany('App\Comment', 'parent_id', 'id')->orderBy('id', 'DESC');
    }
}