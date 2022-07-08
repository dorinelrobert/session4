<?php 

namespace App;

use App\Interface\CharacterInterface;

class Healer extends PlayerCharacter {
	public function healTarget(CharacterInterface $character){
		$character->heal(10);
	}
}