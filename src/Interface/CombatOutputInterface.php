<?php 

namespace App\Interface;

use App\Interface\CharacterInterface;
use App\Healer;

interface CombatOutputInterface {
	public function printStartCombatMessage();
	public function printRoundTitle(int $round);
	public function printGameOver(string $winnerName);
	public function printHealing(Healer $healer, CharacterInterface $healTarget);
	public function printAttack(string $attackerName);
}