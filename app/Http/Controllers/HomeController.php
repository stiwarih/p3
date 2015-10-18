<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Badcow\LoremIpsum\Generator as Generator;

class HomeController extends Controller {

	public function goHome()
	{
		return view('home');
		//return 'home';
	}

	public function goUserDef()
	{
		$faker =\Faker\Factory::create();

		$users = array(
		    0 => array(
					'name'  	=> $faker->name,
			    'address' => $faker->address,
					'email'   => $faker->email,
			    'phone' 	=> $faker->phoneNumber,
					'text'   	=> $faker->text
		    ),
		    1 => array(
					'name'  	=> $faker->name,
			    'address' => $faker->address,
					'email'   => $faker->email,
					'phone' 	=> $faker->phoneNumber,
					'text'   	=> $faker->text
		    )
		);
		return view('user')->with('users', $users)->with('use_email', 0)->with('use_address', 0)->with('use_phoneNumber', 0);
	}

	public function goUser()
	{
		//return $view->with('persons', $persons)->with('ms', $ms);
		return view('user')->with('data', $data);
	}

	public function goUserPost(Request $request = null)
	//public function goIpsumPost()
	{
		$num_users = $request->input('users');
		//if($num_users > 99) die('User count too high');
		$use_email 				= isset( $_POST['email'])?1:0;
		$use_address 			= isset( $_POST['address'])?1:0;
		$use_phoneNumber 	= isset( $_POST['phoneNumber'])?1:0;

		$faker =\Faker\Factory::create();

		$users = array($num_users);

		for($i=0; $i<$num_users; $i++)
		{
				$users[$i] 						= array();
				$users[$i]['name'] 		= $faker->name;
				if($use_address ==1)
				$users[$i]['address'] = $faker->address;
				if($use_email == 1)
				$users[$i]['email'] 	= $faker->email;
				if($use_phoneNumber ==1)
				$users[$i]['phone'] 	= $faker->phoneNumber;
				$users[$i]['text'] 		= $faker->text;
		}
		return view('user')->with('users', $users)->with('num_users', $num_users)->with('use_email', $use_email)->with('use_address', $use_address)->with('use_phoneNumber', $use_phoneNumber);

		}

		public function goIpsum()
		{
			return view('ipsum');
		}

		public function goIpsumDef()
		{
			$generator = new Generator();

			$paragraphs = $generator->getParagraphs(2);
			//echo implode('<p>', $paragraphs);

			return view('ipsum')->with('paragraphs', $paragraphs);
		}

		public function goIpsumPost(Request $request = null)
		//public function goIpsumPost()
		{
			$num = $request->input('paragraphs');

			$generator = new Generator();

			$paragraphs = $generator->getParagraphs($num);
			//echo implode('<p>', $paragraphs);

			return view('ipsum')->with('paragraphs', $paragraphs)->with('num_para', $num);
		}

	public function homeWelcome()
	{
		$this->obtain_thejoson();
		// return view('welcome');
		return 'welcome';
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

        $url ='https://www.randomuser.me/api/';
				$url ='http://api.randomuser.me/';
				//$url = 'http://www.google.com';
        // $url .=  base64_decode($this->mysecret);
         $dump_contents = $this->url_get_contents ($url);
				/*
				if ($dump_contents === false)
				{
				    die("Couldn't fetch the file.");
				}
				*/
				// var_dump($dump_contents);
				$obj = json_decode($dump_contents,true);
        // var_dump($obj); //json as array
				echo('<pre>');
    		var_dump(array_keys($obj['results'][0]['user'])); //json as array
    // var_dump(array_keys($obj)); //print out all keys
    // var_dump(($obj['values'][0]['fromRef']['latestChangeset'])); //json as array
        //return base64_decode($this->mysecret);
				// return (($obj['values'][0]['fromRef']['latestChangeset'])); //json as array

				//fake users
				$faker =\Faker\Factory::create();
				echo $faker->name;

				// paragraphs- lorem ipsum
				$generator = new Generator();
				$paragraphs = $generator->getParagraphs(5);
				echo implode('<p>', $paragraphs);

		}

}
