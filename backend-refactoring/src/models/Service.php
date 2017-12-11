<?php

namespace src\models;

use src\exceptions\ServiceAlreadyDriverException;
use src\exceptions\StatusEqualsToSeisException;

class Service extends Model
{
	public function id()
	{
		return $this->id;
	}

	public function assignDriver(Driver $driver)
	{
		if(!$this->withoutDriverAndStatusEqualTo_1()) 
			throw new ServiceAlreadyDriverException();

		if($this->statusEqualTo('6'))
			throw new StatusEqualsToSeisException();
			  

		$this->setDriver($driver);
		$this->setStatus('2');
		$this->disableDriver($driver);
		$this->assignCar($driver);

		$this->save();
		$driver->save();

	}

	protected function statusEqualTo($status)
	{
		return $this->status_id == $status;
	}

	protected function assignCar($driver)
	{
		$this->car_id = $driver->carId();
	}

	protected function setDriver($driver)
	{
		$this->driver_id = $driver->id();
	}

	protected function setStatus($status)
	{
		$this->status_id = $status;
	}

	protected function disableDriver($driver)
	{
		$driver->disabled();
	}

	protected function withoutDriverAndStatusEqualTo_1()
	{
		return ($this->driver_id == NULL) && ($this->status_id == '1');
	}
}