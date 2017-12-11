<?php

require "Matrix.php";

class Main
{
	public function __construct()
	{
		$this->matrix = new Matrix(2);
	}

	public function execute()
	{
		$this->matrix->updateElement(1,1,1, 50);
		$this->matrix->updateElement(1,1,2, 10);

		$this->assertEquals($this->matrix->query(1,1,1, 1,1,1), 50);
		$this->assertEquals($this->matrix->query(1,1,1, 1,1,2), 60);
	}

	protected function assertEquals($valueA, $valueB)
	{
		$out = $valueA === $valueB ? 'true' : 'false';
		echo "{$out} <br>";
	}

}

(new Main())->execute();
