<?php

class Robot implements RobotInterface
{
	private $is_placed;
	private $position = ['x'=>null, 'y'=>null];
	private $facing;
	private $report = ['position'=>null, 'facing'=>null];

	public function __construct()
	{
		$this->is_placed = false;
	}

	public function place($x, $y, $facing)
	{
		$this->position = ['x'=>$x, 'y'=>$y];
		$this->facing = $facing;
		$this->is_placed = true;
	}

	private function checkStatus($is_placed)
	{
		if ($is_placed == false) {
			echo "PLACE your robot!!!";
			die();
		}
		return true;
	}

	private function checkPosition()
	{
		if ($this->position['x'] < Table::$size['min_x'] && $this->facing == 'WEST') {
			echo "STOP";
			$this->position['x'] = Table::$size['min_x'];

		}elseif ($this->position['x'] > Table::$size['max_x'] && $this->facing == 'EAST') {
			echo "STOP";
			$this->position['x'] = Table::$size['max_x'];

		}elseif ($this->position['y'] < Table::$size['min_y'] && $this->facing == 'SOUTH') {
			echo "STOP";
			$this->position['y'] = Table::$size['min_y'];

		}elseif ($this->position['y'] > Table::$size['max_y'] && $this->facing == 'NORTH') {
			echo "STOP";
			$this->position['y'] = Table::$size['max_y'];
		}
	}

	public function move()
	{
		$this->checkStatus($this->is_placed);
		
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
				echo "Setup facing<br/>";
				break;
		}

		$this->checkPosition();
	}

	public function left()
	{
		$this->checkStatus($this->is_placed);
        
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
		$this->checkStatus($this->is_placed);

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