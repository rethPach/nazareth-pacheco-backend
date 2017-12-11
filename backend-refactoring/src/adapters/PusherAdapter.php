<?php

namespace src\adapters;

interface PusherAdapter {
	public function android($useruuid, $pushMenssage, $numero, $type, $open, $serviceIds);
	public function ios($useruuid, $pushMenssage, $numero, $type, $open, $serviceIds);
}