<?php

class Robot implements RobotInterface
{
	private $is_placed;
	private $position = ['x'=>null, 'y'=>null];
	private $facing;
	private $valid_facing = ["NORTH", "EAST", "SOUTH", "WEST"];
	private $report = ['position'=>null, 'facing'=>null];

	public function __construct()
	{
		$this->is_placed = false;
	}

	public function place($x, $y, $facing)
	{	
		$this->checkPlace($x, $y, $facing);
		$this->checkPosition();
	}

	private function checkPlace($x, $y, $facing)
	{
		if (in_array($facing, $this->valid_facing) && is_numeric($x) && is_numeric($y)) {
			$this->position = ['x'=>$x, 'y'=>$y];	
			$this->facing = $facing;
			$this->is_placed = true;
		}else{
			echo "INVALID PLACE COMMAND!";
			die();
		}
	}

	private function checkStatus($is_placed)
	{
		if ($is_placed == false) {
			echo "PLACE YOUR ROBOT!!!";
			die();
		}
		return true;
	}

	private function checkPosition()
	{
		if ($this->position['x'] < Table::$size['min_x']) {
			echo "STOP, X CAN'T BE < 0</br>";
			$this->position['x'] = Table::$size['min_x'];

		}elseif ($this->position['x'] > Table::$size['max_x']) {
			echo "STOP, X CAN'T BE > 5</br>";
			$this->position['x'] = Table::$size['max_x'];

		}elseif ($this->position['y'] < Table::$size['min_y']) {
			echo "STOP, Y CAN'T BE < 0</br>";
			$this->position['y'] = Table::$size['min_y'];

		}elseif ($this->position['y'] > Table::$size['max_y']) {
			echo "STOP, Y CAN'T BE > 5</br>";
			$this->position['y'] = Table::$size['max_y'];
		}
	}

	public function move()
	{		
		switch ($this->facing) {
			case 'NORTH':
				$this->position['y']++;
				break;
			case 'EAST':
				$this->position['x']++;
				break;
			case 'SOUTH':
				$this->position['y']--;
				break;
			case 'WEST':
				$this->position['x']--;
				break;
			default:
				echo "PLACE ME PROPERLY OR I CAN'T GO ANYWHERE!!!<br/>";
				break;
		}

		$this->checkPosition();
	}

	public function left()
	{        
		switch ($this->facing) {
			case 'NORTH':
				$this->facing = "WEST";
				break;
			case 'EAST':
				$this->facing = "NORTH";
				break;
			case 'SOUTH':
				$this->facing = "EAST";
				break;
			case 'WEST':
				$this->facing = "SOUTH";
				break;
		}
	}

	public function right()
	{
		switch ($this->facing) {
			case 'NORTH':
				$this->facing = "EAST";
				break;
			case 'EAST':
				$this->facing = "SOUTH";
				break;
			case 'SOUTH':
				$this->facing = "WEST";
				break;
			case 'WEST':
				$this->facing = "NORTH";
				break;
		}
	}

	public function report()
	{
		return $this->report = ['positionX'=>$this->position['x'], 
		                        'positionY'=>$this->position['y'], 
		                        'facing'=>$this->facing];
	}
}