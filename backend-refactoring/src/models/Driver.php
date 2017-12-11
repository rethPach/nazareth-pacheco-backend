<?php

namespace src\models;

class Driver extends Model
{

	public function id()
	{
		return $this->id;
	}

	public function disabled()
	{
		$this->avalaible = '0';
	}

	public function carId()
	{
		return $this->car_id;
	}

}