<?php

namespace src\repositories;

use src\adapters\DriverRepo;
use src\exceptions\ModelNotFoundException;

class DriverRepoEloquent implemets DriverRepo
{
	public function __construct(){}

	public function find($id)
	{
		$driver = Driver::find($id);

		if(is_null($driver)) throw new DriverNotFoundException();
		
		return $driver;		
	}
}