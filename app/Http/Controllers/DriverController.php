<?php

namespace App\Http\Controllers;

use App\Http\Controllers\HomeController;

class DriverController extends HomeController {

		public function restControl()
		{
			return $this->obtain_thejoson();
		}

}
