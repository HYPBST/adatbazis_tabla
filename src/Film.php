<?php

namespace adatbazis\tabla;

use Illuminate\Database\Eloquent\Model;

class Film extends Model {
    protected $table = 'filmek';
    public $timestamps = false;
    protected $guarded = ['id'];
}
