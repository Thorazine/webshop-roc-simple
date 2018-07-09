<?php

Class Tool {

	public static function roulette(int $chance = 50)
	{
		return (rand(1, $chance) == 1);
	}
}
