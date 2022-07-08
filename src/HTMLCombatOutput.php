<?php 

namespace App;

use App\Interface\CombatOutputInterface;
use App\Interface\CharacterInterface;
use App\Healer;

class HTMLCombatOutput implements CombatOutputInterface {
	public function printStartCombatMessage(){
		echo '<h3>Start</h3>';
	}

	public function printRoundTitle(int $round){
		echo '<h4> Round: ' . $round . '</h4>';
	}

	public function printGameOver(string $winnerName){
		echo '<h4>Game over!</h4>'
			.'<p>Winner: ' . $winnerName . '</p>';
	}

	public function printHealing(Healer $healer, CharacterInterface $healTarget){
		echo '<p>' . $healer->getName() . ' heal ' . $healTarget->getName() . ' ( ' . $healTarget->getCurrentHealth() . ' hp remaining)</p>';
	}

	public function printAttack(string $attackerName){
		echo '<p>' . $attackerName . ' attack:</p>';
	}

	public function printDamageReceived($defender, $attacker){
		echo '<p>' . $defender->getName() . ' took ' . $defender->getLastDamageReceived() 
					. ' damage from ' . $attacker->getName() . ' (' . $defender->getCurrentHealth() . ' hp remaining)</p>';
	}

	public function printDestroyed($characterName){
		echo '<p>' . $characterName . ' is destroyed.</p>';
	}
}