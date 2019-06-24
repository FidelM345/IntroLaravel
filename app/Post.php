<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // //Table name
    // protected $table='posts';

    //  //Table name
    //  protected $primaryKey='id';

    //  //Timestamps
    //  protected $timestamps=true;


    //a post belongs to a single user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    
}
