<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    function reviews() {
        return $this->hasMany('App\Review');
    }

    function reviewsPaginated($itemsPerPage) {
        return $this->reviews()->paginate($itemsPerPage);
    }


}
