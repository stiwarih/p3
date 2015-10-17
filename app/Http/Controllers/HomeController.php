<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
		/*echo $faker->name;
		echo $faker->address;
	  echo $faker->text;
		echo $faker->phoneNumber
		echo $faker->email;
		*/
//return $view->with('persons', $persons)->with('ms', $ms);
/*
		$users = array(
    'name'  	=> $faker->name,
    'address' => $faker->address,
		'email'   => $faker->email,
		'text'   	=> $faker->text,
    'phone' 	=> $faker->phoneNumber
		);

		return view('user')->with('users', $users);
//blade
		<section>
		@foreach($paragraphs as $paragraph)
		 {{ $paragraph }}
		@endforeach
		</section>
*/
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
		return view('user')->with('users', $users);
	}

	public function goUser()
	{
		//return $view->with('persons', $persons)->with('ms', $ms);
		return view('user')->with('data', $data);
	}


		public function goIpsum()
		{
			return view('ipsum');
		}

		public function goIpsumDef()
		{

			/*
			$temp = 'sanjay tiwari';
			return view('user')->with('temp', $temp);
			*/
			//return $view->with('persons', $persons)->with('ms', $ms);

			$generator = new Generator();

			$paragraphs = $generator->getParagraphs(5);
			//echo implode('<p>', $paragraphs);

			return view('ipsum')->with('paragraphs', $paragraphs);

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
