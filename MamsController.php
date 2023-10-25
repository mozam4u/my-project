<?php
namespace App\Http\Controllers;
use App\Exports\MamsUsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use App\Mams;


class MamsController extends Controller
{
    
    public function index()
    {
// $data= DB::table('transaction_image')->select('eventdate','updateddate','lastmodifydate','shootdate','HiresPath','OriginalPath','orgfilename','activestatus','copyright','shootdate')->latest()->take(10)->get();
$datequery = Request::input('date');

if (empty($datequery)) {
    return "<br/><strong><font color='red'>Please Insert Date Query Parameter </font></strong><br/><br/>";
}
function fileUrl($url)
    {
        $parts = parse_url($url);
        $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
        return $parts['scheme'] . '://' . $parts['host'] . implode('/', array_map('rawurlencode', $path_parts));
    }

$data = Mams::select('eventdate','updateddate','lastmodifydate','shootdate','HiresPath','OriginalPath','orgfilename','activestatus','copyright','shootdate')
        // ->where('shootdate', '=', $datequery . '00:00:00')
        ->where('eventdate', '=', $datequery)
        ->where('activestatus', '=', 'A')
        ->where('copyright', '!=', '')
        ->where('categoryid', '!=', '')
        ->where('copyright', 'not like', '%not%')
        ->where(function ($query) {
        $query->where('itemcaption', 'not like', '%NOT FOR SALE OR SYNDICATION%')
                    ->where('itemcaption', 'not like', '%Not for Syndication or Sale')
                    ->where('itemcaption', 'not like', '%NOT FOR SALE%')
                    ->where('itemcaption', 'not like', '%Not for Syndication%')
                    ->where('itemcaption', 'not like', '%Jishu%');

                  
            })       
        ->take(1000)
        ->get();
        ini_set('max_execution_time', 3600);
        
return view('exports.download')->with('data', $data);

// return Excel::download(new MamsUsersExport, 'mams.xlsx');
      
    }

    public function download()
    {
        $stringValue = 'date=';
        $datequery = Request::input('date');
        return Excel::download(new MamsUsersExport, 'mams.xlsx');// Replace with your own export class and filename
   
   
        if (empty($datequery)) {
            return "<br/><strong><font color='red'>Please Insert Date Query Parameter </font></strong><br/><br/>";
        }
               
        // return Mams::select('itemid','itemfilename','itemkeyword','itemlength','itemsize','cityid','stateid','countryid','genre','shootdate','MergeMultipleCol')
        //     ->where('shootdate', '=',
        //          $datequery . ' 00:00:00')
        //        ->where('activestatus', '=', 'A')
        //        ->where('copyright', '!=', '')
        //        ->where('copyright', 'not like', '%not%')
        //        ->get();
               }
}

