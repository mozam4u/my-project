<?php

namespace App\Exports;
use App\Mams;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Facades\Request;
use Maatwebsite\Excel\Facades\Excel;
  
class MamsUsersExport implements FromCollection 
{
   
    public function collection()
    
    {
        $datequery = Request::input('date');

if (empty($datequery)) {
    return "<br/><strong><font color='red'>Please Insert Date Query Parameter </font></strong><br/><br/>";
}



    //     return Mams::select('itemid','itemfilename','itemkeyword','itemlength','itemsize','cityid','stateid','countryid','genre','shootdate','MergeMultipleCol')
    //     ->where('shootdate', '=',
    //      $datequery . ' 00:00:00')
    //    ->where('activestatus', '=', 'A')
    //    ->where('copyright', '!=', '')
    //    ->where('copyright', 'not like', '%not%')->get();
       
    //    return Mams::select
    //    ('projectkey', 'status')
    //    ->selectRaw('CONCAT("update jira_project set name=", projectkey ,"where projectkey=", projectkey )  AS updatequery')
    //    ->get(); 
      
return Mams::select
       ('itemfilename')                         
       ->selectRaw('CONCAT ("UPDATE ISMPBI SET  PBIDMSASSESTID= ","\"" ,(itemid) ,"\""  , ","
                                               "PBIKEYWORD= ","\"" , itemkeyword ,"\""  , ","
                                               "PBIDMSITEMLENGTH= ","\"" , itemlength ,"\""  , ","
                                               "PBIDMSITEMSIZE= ","\"" , itemsize ,"\""  , ","
                                               "pbicity= ","\"" , cityid ,"\""  , ","
                                               "pbistate= ","\"" , stateid ,"\""  ,","
                                               "pbicountry= ","\"" , countryid ,"\""  , ","
                                               "PBIDMSGENRE= ","\"" , genre ,"\""  , ","
                                               "PBIDATETAKEN= ","\"" , DATE(shootdate) ,"\""  , ","
                                               "PBIDMSEVENTDATE= ","\"" ,eventdate ,"\""  , ","
                                               "PBIDMSMERGEMULTIPLECOL= ","\"" , MergeMultipleCol ,"\"","  "
                                               "WHERE PBIDMSITEMFILENAME =","\"" ,  itemfilename ,"\"" ) AS UPDATEDQUERY') 
                                            //   ->where('shootdate', '=',
                                            //    $datequery . ' 00:00:00')
                                              ->where('eventdate', '=', $datequery)
                                              ->where('activestatus', '=', 'A')
                                              ->where('copyright', '!=', '')
                                              ->where('categoryid', '!=', '')
                                              ->where('copyright', 'not like', '%not%') 
                                              ->get(); 
                                           ini_set('max_execution_time', 600);

                                           return Excel::download(new MamsUsersExport, 'mams.xlsx' , ['Content-Type' => 'text/csv', 'charset' => 'UTF-8']);
       
    //    return Mams::select
    //    ('itemid')
    //    ->selectRaw('CONCAT("update jira_project set name=", projectkey ,"where projectkey=", projectkey )  AS updatequery')
    //    ->get(); 

   
       
    

        //  return Mams::select('HiresPath')->take(100)->get();
    }
    
}

 