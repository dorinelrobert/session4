<?php 

namespace App\Abstract;

use App\Interface\CharacterInterface;

abstract class GenericCharacter {
	protected $name;
	protected $maxHealth;
	protected $currentHealth;
	protected $baseDamage;
	protected $lastDamageReceived;

	const DAMAGE_VARIATION = 5;

	public function __construct(string $name, int $maxHealth, int $baseDamage){
		$this->name 			= $name;
		$this->maxHealth 		= $maxHealth;
		$this->currentHealth 	= $maxHealth;
		$this->baseDamage 		= $baseDamage;
	}


	public function getName(){
		return $this->name;
	}

	public function getCurrentHealth(){
		return $this->currentHealth;
	}

	public function getDamage(){
		return rand($this->baseDamage - self::DAMAGE_VARIATION, $this->baseDamage + self::DAMAGE_VARIATION);
	}

	public function heal(int $n){
		if($this->currentHealth + $n >= $this->maxHealth){
			$this->currentHealth = $this->maxHealth;
		} else {
			$this->currentHealth += $n;
		}

		return $this;
	}

	public function takeDamage(int $n){
		if($this->currentHealth - $n <= 0){
			$this->currentHealth = 0;
		} else {
			$this->lastDamageReceived = $n;
			$this->currentHealth -= $n;
		}

		return $this;
	}

	public function getLastDamageReceived(){
		return $this->lastDamageReceived;
	}

	public function isAlive(){
		return $this->currentHealth > 0;
	}

	public function __call($member, $arguments) {
	    if($member == 'attack'){
    		$arguments[0] instanceof CharacterInterface 
    			? $this->attackSingle($arguments[0]) 
    			: throw new \Exception('A player can only attack one character');	
    	} else {
    		throw new \Exception('This method does not exist');
    	}
	}

	public function attackSingle(CharacterInterface $character){
		$character->takeDamage($this->getDamage());
	}
}