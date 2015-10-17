<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse as JSONFile;

class HomeController extends Controller {

	public function homeWelcome()
	{
		$this->obtain_thejoson();
		return view('welcome');
	}

	public function url_get_contents ($url)
  {
         if (function_exists('curl_exec')){
					 	 //print_r('1');
				     $conn = curl_init($url);
             curl_setopt($conn, CURLOPT_SSL_VERIFYPEER, true);
             curl_setopt($conn, CURLOPT_FRESH_CONNECT,  true);
             curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
             $url_get_contents_data = (curl_exec($conn));
             curl_close($conn);
         }elseif(function_exists('file_get_contents')){
					 	 //print_r('2');
             $url_get_contents_data = file_get_contents($url);
         }elseif(function_exists('fopen') && function_exists('stream_get_contents')){
					   //print_r('3');
             $handle = fopen ($url, "r");
             $url_get_contents_data = stream_get_contents($handle);
         }else{
					 		//print_r('4');
             $url_get_contents_data = false;
         }
         return $url_get_contents_data;
  }

	private function obtain_thejoson()
  {

        $url = 'https://randomuser.me/api/';
				//$url = 'http://www.google.com';
        // $url .=  base64_decode($this->mysecret);
        // $url .= '@stash.micron.com/stash/rest/api/1.0/projects/JEN/repos/test_pr/pull-requests';
         //$dump_contents = $this->url_get_contents ($url);
				//$dump_contents = File::getRemote($url);
if ($dump_contents === false)
{
    die("Couldn't fetch the file.");
}
				var_dump($dump_contents);
				$obj = json_decode($dump_contents,true);
        var_dump($obj); //json as array
    // var_dump(array_keys($obj)); //json as array
    // var_dump(array_keys($obj)); //print out all keys
    // var_dump(($obj['values'][0]['fromRef']['latestChangeset'])); //json as array
        //return base64_decode($this->mysecret);
				// return (($obj['values'][0]['fromRef']['latestChangeset'])); //json as array


        }

}
