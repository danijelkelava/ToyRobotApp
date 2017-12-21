<?php 

interface RobotInterface
{
	public function move();
	public function left();
	public function right();
	public function place($x, $y, $facing);
	public function report();
}