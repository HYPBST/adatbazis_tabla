<?php

namespace adatbazis\tabla;

use Illuminate\Database\Eloquent\Model;

class Felhasznalo extends Model {
    protected $table = 'felhasznalok';
    public $timestamps = false;
    protected $guarded = ['id'];
}
