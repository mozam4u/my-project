<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class Mams extends Model
{


    const CREATED_AT = 'eventdate';
    const UPDATED_AT = 'eventdate';
    
    protected $table = "transaction_image";

     protected $original = ["HiresPath"];

     protected $fillable = [
        'itemid','itemfilename','itemkeyword','itemlength','itemsize','cityid',
        'stateid','countryid','genre','shootdate','MergeMultipleCol'
    ];

    public function model(array $row)
    {
        return new Mams([
            'itemid'  => $row['itemid'],
            'itemfilename' => $row['itemfilename'],
            'itemid'  => $row['itemid'],
            'itemfilename' => $row['itemfilename'],
            'itemid'  => $row['itemid'],
            'itemfilename' => $row['itemfilename'],
            'itemid'  => $row['itemid'],
            'itemfilename' => $row['itemfilename'],
            'itemid'  => $row['itemid'],
            'itemfilename' => $row['itemfilename'],
          
        ]);
    }
  
     
}

