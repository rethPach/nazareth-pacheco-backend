<?php

namespace src\http;

use src\repositories\ServiceRepoEloquent;
use src\repositories\DriverRepoEloquent;
use src\useCases\AsignarDriverToService;
use src\exceptions\ServiceAlreadyDriverException;
use src\exceptions\StatusEqualsToSeisException;
use src\exceptions\ServiceNotFoundException;
use src\exceptions\DriverNotFoundException;

class CrazyController {

	public function __construct()
	{
		$this->asignarDriverToService = new AsignarDriverToService(
			new ServiceRepoEloquent(),
			new DriverRepoEloquent(),
			Push::make()
		);
	}

	public function post_confirm() {

		try {
			$this->asignarDriverToService->handle(
				Input::get('service_id'), 
				Input::get('driver_id'),
				Input::get('push_message')
			);

			return Response::json(array('error' => '0'));
		}

		catch(ServiceAlreadyDriverException $e) {
			return Response::json(array('error' => '1'));
		}

		catch(StatusEqualsToSeisException $e) {
			return Response::json(array('error' => '2'));
		}

		catch(ServiceNotFoundException $e) {
			return Response::json(array('error' => '3'));
		}

		catch(DriverNotFoundException $e) {
			//return Response::json();
		}
			
	}

}