<?php

namespace src\adapters;

interface ServiceRepo {
	public function findOrFail($id);
}