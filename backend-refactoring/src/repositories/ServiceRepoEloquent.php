<?php

namespace src\repositories;

use src\adapters\ServiceRepo;
use src\exceptions\ModelNotFoundException;

class ServiceRepoEloquent implemets ServiceRepo
{
	public function __construct(){}

	public function find($id)
	{
		$servicio = Service::find($id);

		if(is_null($servicio)) throw new ServiceNotFoundException();
		
		return $servicio;		
	}
}