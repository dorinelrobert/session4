<?php

namespace App\Interface;

interface CharacterInterface {
	public function getDamage();
	public function heal(int $n);
	public function takeDamage(int $n);	
}