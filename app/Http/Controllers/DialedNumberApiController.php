<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DialedNumberApiController extends Controller
{
    public static function MatchDialedNumbers($dnsNumbers)
    {

        $dnsList = implode(',', $dnsNumbers);
        $userid = "attapi";
        $password = "attapi";
        $requestType = "BatchNumberQuery";
        $requestParameter = "dnlist~$dnsList;comment~Query%20three%20numbers";

        $response = Http::acceptJson()->get('https://atttest.8msweb.com/8ms/api', [
            'userid' => $userid,
            'password' => $password,
            'request' => $requestType,
            'reqparams' => $requestParameter
        ]);
        // dd($response);
        // Parse response body from xml.
        $xml = simplexml_load_string($response->getBody(), 'SimpleXMLElement', LIBXML_NOCDATA);
        // json encode parsed data
        $json = json_encode($xml);
        // decode json to create an array object
        $responseArray = json_decode($json, true);
        //dd($responseArray);
        $messageArray = $responseArray["message"];
        // dd($messageArray);
        $returnArray = [];
        foreach ($messageArray as $key => $phoneRecord) {
            if (isset($phoneRecord['msgparams'])) {
                $messageParams = explode(PHP_EOL, $phoneRecord['msgparams']);
                $ro = explode('=', $messageParams[2])[1];
                $num = explode('=', $messageParams[4])[1];
                $stat = explode('=', $messageParams[7])[1];
                $returnArray[] = [
                    'ro' => $ro,
                    'num' => $num,
                    'stat' => $stat
                ];
            }
        }

        foreach ($dnsNumbers as $number) {
            $returnNumbers = array_filter($returnArray, function ($obj) use ($number) {
                return $obj['num'] === $number;
            }, ARRAY_FILTER_USE_BOTH);

            if (count($returnNumbers) == 0) {
                $returnArray[] = [
                    'ro' => 'N/A',
                    'num' => $number,
                    'stat' => 'UNAVAIL'
                ];
            }
        }

        return $returnArray;
    }
}
