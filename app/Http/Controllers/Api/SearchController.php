<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use SoapClient;

class SearchController extends Controller
{
    public function search(Request $request){
        $q = $request->q;
        $q = str_replace(' ', '+', $q);
        $response1 = Http::get('https://itunes.apple.com/search?media=movie&term='.$q);
        $response2 = Http::get('https://itunes.apple.com/search?media=music&term='.$q);
        $response3 = Http::get('https://itunes.apple.com/search?media=ebook&term='.$q);
        $response4 = Http::get('http://api.tvmaze.com/search/shows?q='.$q);
        $result = array();

        $opts = array(
            'ssl' => array('ciphers'=>'RC4-SHA', 'verify_peer'=>false, 'verify_peer_name'=>false)
        );
        $params = array ('encoding' => 'UTF-8', 'verifypeer' => false, 'verifyhost' => false, 
        'soap_version' => SOAP_1_2, 'trace' => 1, 'exceptions' => 1, "connection_timeout" => 180, 
        'stream_context' => stream_context_create($opts) );
        $url = "http://webservices.oorsprong.org/websamples.countryinfo/CountryInfoService.wso?WSDL";
        try{
            $client = new SoapClient($url, $params);
            $response5 = $client->CountriesUsingCurrency(['sISOCurrencyCode'=>$q]);
        } catch (SoapFault $th) {
            echo 'br'.$th;
        }


        foreach ($response1['results'] as $key => $value) {
            array_push($result, ['name'=>$value['trackName'], 'type' => $value['kind'], 'from'=>'itunes'] );
        }

        foreach ($response2['results'] as $key => $value) {
            array_push($result, ['name'=>$value['trackName'], 'type' => $value['kind'], 'from'=>'itunes'] );
        }

        foreach ($response3['results'] as $key => $value) {
            array_push($result, ['name'=>$value['trackName'], 'type' => $value['kind'], 'from'=>'itunes'] );
        }

        foreach ($response4->json() as  $value) {
            array_push($result, ['name'=>$value['show']['name'], 'type' => $value['show']['type'], 'from'=>'tvmaze'] );
        }
        
        if(property_exists ( $response5->CountriesUsingCurrencyResult , 'tCountryCodeAndName' ) ){
            if(is_array($response5->CountriesUsingCurrencyResult->tCountryCodeAndName)){
                foreach ($response5->CountriesUsingCurrencyResult->tCountryCodeAndName as $key => $value) {
                    array_push($result, ['name'=>$value->sName, 'type' => 'curency of country', 'from'=>'SOAP'] );
                }
            }else{
                array_push($result, ['name'=>$response5->CountriesUsingCurrencyResult->tCountryCodeAndName->sName, 'type' => 'curency of country', 'from'=>'SOAP'] );
            }
        }
        

        
        usort($result, 'App\Http\Controllers\Api\SearchController::sortByName');

        
        return response()->json($result, 200);
    }



       public function sortByName($a, $b) {
            return $a['name'] > $b['name'];
        }




}
