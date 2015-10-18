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
					'email'   => $faker->email,
					'address' => $faker->address,
			    'phone' 	=> $faker->phoneNumber,
					'text'   	=> $faker->text
		    ),
		    1 => array(
					'name'  	=> $faker->name,
					'email'   => $faker->email,
					'address' => $faker->address,
					'phone' 	=> $faker->phoneNumber,
					'text'   	=> $faker->text
		    )
		);
		return view('user')->with('users', $users)->with('use_email', 1)->with('use_address', 1)->with('use_phoneNumber', 1);
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
				if($use_email == 1)
				$users[$i]['email'] 	= $faker->email;
				if($use_address ==1)
				$users[$i]['address'] = $faker->address;
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

	public function restControl()
	{
		return $this->obtain_thejoson();
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

	public function obtain_thejoson()
	{
				$url ='http://api.randomuser.me/';
        $dump_contents = $this->url_get_contents ($url);
				$obj = json_decode($dump_contents,true);
        //echo('<pre>');
    		//var_dump(array_keys($obj['results'][0]['user'])); //json as array
				//var_dump(($obj['results'][0]['user']['picture']['medium']));

				$users = array(
						0 => array(
							'user'  			=> 'Name: ' . $obj['results'][0]['user']['name']['first'],
							'location'   	=> 'City: ' . $obj['results'][0]['user']['location']['city'],
							'email' 			=> 'Email: ' . $obj['results'][0]['user']['email'],
							'username'  	=> 'username: ' . $obj['results'][0]['user']['username'],
							'phone' 			=> 'Phone#: ' . $obj['results'][0]['user']['phone'],
							'cell'   			=> 'Cell#: ' . $obj['results'][0]['user']['cell']
						)
				);

				//var_dump(array_keys($obj)); //print out all keys
				return view('user1')->with('users', $users)->with('image', $obj['results'][0]['user']['picture']['medium']);
		}

}
