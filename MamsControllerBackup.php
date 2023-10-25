<?php

namespace App\Http\Controllers;
use App\Exports\MamsUsersExport;
use Maatwebsite\Excel\Facades\Excel;

use App\Mams;
use DB;

use Illuminate\Http\Request;

class MamsController extends Controller
{
    public function index()
    {
        $url = 'https://itgdms.intoday.com/mams/';
        $data = Mams::latest()->take(10)->get();
        //  return view('exports.welcome')->with('data', $data);

        // return Excel::download(new MamsUsersExport, 'mams.xlsx');
  return view('exports.download', compact('url'))->with('data', $data);


        
    }
}
