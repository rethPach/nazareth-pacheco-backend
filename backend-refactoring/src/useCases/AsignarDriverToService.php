<?php

namespace src;

use src\adapters\ServiceRepo;
use src\adapters\DriverRepo;
use src\adapters\PusherAdapter;

class AsignarDriverToService
{

	public function __construct(PusherAdapter $pusher, ServiceRepo $serviceRepo, DriverRepo $driverRepo)
	{
		$this->push = $pusher;
		$this->serviceRepo = $serviceRepo;
		$this->driverRepo = $driverRepo;
	}

	public function handle($serviceId, $driverId, $pushMenssage)
	{
		$servicio = $this->serviceRepo->findOrFail($serviceId);
		$driver = $this->driverRepo->findOrFail($driverId);

		$servicio->assignDriver($driver);

		$this
		->pushIos($servicio, $pushMenssage);
		->orPushAndroid($servicio, $pushMenssage);
	}


	protected function pushIos($servicio, $pushMenssage)
	{
		if($servicio->user->uuid == '') {
			$this->setPushResponse($this->push->ios(
				$servicio->user->uuid, $pushMenssage, 1,
				'honk.wav', 'Open', array('serviceId'=>$servicio->id) 
			));
		}

		return $this;

	}

	protected function orPushAndroid($servicio, $pushMenssage)
	{
		if($servicio->user->uuid == '') return;
		
		$this->setPushResponse($this->push->android(
			$servicio->user->uuid, $pushMenssage, 1,
			'default', 'Open', array('serviceId'=>$servicio->id) 
		));

	}

	protected function setPushResponse($response)
	{
		$this->pushResponse = $response;
	}

	protected function getPushResponse()
	{
		return $this->pushResponse;
	}
}