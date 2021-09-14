<?php

namespace App\Http\Controllers;

use App\Http\Controllers\DialedNumberApiController;
use App\Jobs\csvParsingJob;
use Illuminate\Http\Request;
use App\Models\testqueue;
use Illuminate\Support\Facades\File;

class CsvParsingController extends Controller
{
    public function index(){
        return view('csv_parsing');
    }
    public function csvParseQueue(Request $request)
    {
        // $validator = Validator::make(
        //     [
        //     'file'      => $request->file,
        //         'extension' => strtolower($request->file->getClientOriginalExtension()),
        //     ],
        //     [
        //         'file'          => 'required|max:5000',
        //         'extension'      => 'required|in:csv',
        //     ]
        // );
        $testQueueTable=new testqueue();
        if($request->has('file'))
        {
            $csvFileName=$request->file;
            $readCsv=$this->readCsv($csvFileName);
            // dd($readCsv);
            if($readCsv == null){
               return redirect()->back()->with('error','Invalid File');
            }
            $chunk=$this->chunking($readCsv);
            $savePath=storage_path(). '/app/public/uploads' . '/csv' . '/';
            $this->createPathIfNotExists($savePath);
            $extension=$csvFileName->getClientOriginalExtension();
            $dialedNumberFileName=time(). '.' .$extension;
            $csvFileName->move($savePath,$dialedNumberFileName);
            $testQueueTable->file=$dialedNumberFileName;
            $testQueueTable->save();
        }
        $chunksDialedNumberJobs=[];
        foreach ($chunk as $key => $value) {
            //Send dialed number to api for check status of dialed number
             csvParsingJob::dispatch($value);
        }
        // dd($chunksDialedNumberJobs);
        return redirect()->back();
    }

    //Chunking the data of csv Array
    public function chunking($readCsv){
        $collection = collect($readCsv);
        $chunks = $collection->chunk(3)->toArray();
        return $chunks;
    }

    //Link command storage folder to public folder  => php artisan storage:link

    public function createPathIfNotExists($path){
        if(!File::isDirectory($path)){
            File::makeDirectory($path,0777,true,true);
        }
    }

    //Read Csv File
    public function readCsv($csvFile)
    {
        $textArray=[];
        $invalid= false;
        $fileHandle=fopen($csvFile,'r');
        while(!feof($fileHandle)){
            $array=fgetcsv($fileHandle,0);
            if($array)
            {
                if(!$this->validateDnCsv($array[0]) || count($array) != 1){
                    $invalid=true;
                    break;
                }
                $textArray[]=$array[0];
            }
        }
        fclose($fileHandle);
        if($invalid){
            return null;
        }
        return $textArray;

    }
    public function validateDnCsv($number)
    {

        $number=str_replace("-","",$number);
        // Should be 10 digit long
        // Should be a number
        // Check if 2nd and 3rd values are same
        if((!is_numeric($number)) || strlen($number) !=  10 || ($number[1] != $number[2]))
        {
           return false;
        }
        return true;
    }
}
