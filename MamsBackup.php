<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mams extends Model
{


    const CREATED_AT = 'eventdate';
    const UPDATED_AT = 'eventdate';
    
    protected $table = "transaction_image";

     protected $original = ["HiresPath"];
}
