<?php

namespace App\Jobs;

use App\Http\Controllers\DialedNumberApiController;
use App\Models\DialedNumber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class csvParsingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $chunk;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($chunk)
    {
        $this->chunk=$chunk;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $hi= "hello";
        //   dd($this->chunk);
        $returnArray = DialedNumberApiController::MatchDialedNumbers($this->chunk);
        // dd($returnArray);
        if (isset($returnArray) && $returnArray != null) {
            foreach ($returnArray as $key => $value) {
                //   dd($value);
                $num = $this->createDialedNumber($value);
            }
        }
    }
    public function CreateDialedNumber($value){
       $dialed_number= new DialedNumber();
        

    }
}
