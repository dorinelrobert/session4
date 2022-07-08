<?php 

namespace App;

use App\Interface\CharacterInterface;
use App\Abstract\GenericCharacter;

class EnemyCharacter extends GenericCharacter implements CharacterInterface {

	public function __call($member, $arguments) {
	    if($member == 'attack'){
    		is_array($arguments[0]) 
    			? $this->attackArray($arguments[0]) 
    			: throw new \Exception('An enemy can only attack an array of characters');	
    	}
	}

	public function attackArray(array $characterArr){
		foreach($characterArr as $character){
			$this->attackSingle($character);
		}
	}
}