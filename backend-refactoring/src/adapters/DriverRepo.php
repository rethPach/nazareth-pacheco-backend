<?php

namespace src\adapters;

interface DriverRepo {
	public function findOrFail($id);
}