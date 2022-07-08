<?php 

namespace App;

class Tank extends PlayerCharacter {
	const MITIGATION = 10;

	public function takeDamage(int $n){
		if($this->currentHealth - $n <= 0){
			$this->currentHealth = 0;
		} else {
			$this->lastDamageReceived = $n - self::MITIGATION; 
			$this->currentHealth -= $this->lastDamageReceived;
		}

		return $this;
	}
}