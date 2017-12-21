<?php

class Validation
{
	public static $error;

	public static function checkStatus($is_placed)
	{
		if ($is_placed == false) {
			echo "PLACE your robot!!!";
			die();
		}
		return true;
	}

	public static function checkPosition($positionX, $positionY, $facing)
	{
		if ($positionX == Table::$table_size['min_x'] && $facing == 'WEST') {
			echo "STOP";
			die();
		}elseif ($positionX == Table::$table_size['max_x'] && $facing == 'EAST') {
			echo "STOP";
			die();
		}elseif ($positionY == Table::$table_size['min_y'] && $facing == 'SOUTH') {
			echo "STOP";
			die();
		}elseif ($positionY == Table::$table_size['max_y'] && $facing == 'NORTH') {
			echo "STOP";
			die();
		}
	}
}