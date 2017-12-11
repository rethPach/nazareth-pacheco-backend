<?php

class Matrix 
{
	protected $matrixDefinition;
	protected $elements;

	public function __construct($matrixDefinition)
	{
		$this->setMatrixDefinition($matrixDefinition);
		$this->build();
	}

	protected function setMatrixDefinition($matrixDefinition)
	{
		$this->matrixDefinition = $matrixDefinition;
	}

	protected function build()
	{
		$this->elements = [];

		$this->iterator(function($x, $y, $z) {
			$this->elements[$x][$y][$z] = 0; 
		});
	}

	protected function iterator($cb)
	{
		for($x=1; $x <= $this->matrixDefinition; $x++)
			for($y=1; $y <= $this->matrixDefinition; $y++)
				for($z=1; $z <= $this->matrixDefinition; $z++)
					$cb($x, $y, $z);
	}

	public function query($x1, $y1, $z1, $x2, $y2, $z2) 
	{
		$this->sumatoria = 0;

		$this->iterator(function($x, $y, $z) use($x1, $y1, $z1, $x2, $y2, $z2){
			if($this->intoRange($x1, $x2, $x) && 
				$this->intoRange($y1, $y2, $y) 
				&& $this->intoRange($z1, $z2, $z)) {
				
				$this->incrementSumatoria($x, $y, $z);
			}
		});

		return $this->sumatoria;
	}

	protected function incrementSumatoria($x, $y, $z)
	{
		$this->sumatoria += $this->elements[$x][$y][$z];
	}

	public function intoRange($inicio, $fin, $x)
	{
		return ($x >= $inicio) && ($x <= $fin);
	}

	public function updateElement($x, $y, $z, $w)
	{
		$this->elements[$x][$y][$z] = $w;
	}
}



