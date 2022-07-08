<?php 

namespace App;

use App\Interface\CombatOutputInterface;

class Game {
	private $output;
	private $players = [];
	private $enemy;
	private $round = 0;
	private $playersTeamName;

	public function __construct(CombatOutputInterface $output){
		$this->output = $output;
	}

	public function addPLayer(PlayerCharacter $playerCharacter){
		$this->players[] = $playerCharacter;
	}

	public function setPlayersTeamName(string $playersTeamName){
		$this->playersTeamName = $playersTeamName;
	}

	public function getPlayersTeamName(){
		return $this->playersTeamName;
	}

	public function setEnemy(EnemyCharacter $enemyCharacter){
		$this->enemy = $enemyCharacter;
	}

	private function getRandomPlayer(){
		return $this->players[array_rand($this->players)];
	}

	private function getHealerPlayer(){
		foreach($this->players as $player){
			if($player instanceof Healer){
				return $player;
			}
		}
	}

	private function anyPlayerAlive(){
		$alivePlayers = array_filter($this->players, function($player){
			return $player->isAlive();
		});

		return count($alivePlayers) > 0;
	}

	private function enemyAttack(){
		$this->output->printAttack($this->enemy->getName());
		$this->enemy->attack($this->players);

		foreach($this->players as $player){
			if($player->isAlive()){
				$this->output->printDamageReceived($player, $this->enemy);	
			} else {
				$this->output->printDestroyed($player->getName());
			}
		}

		$healer = $this->getHealerPlayer();
		$randomPlayer = $this->getRandomPlayer();

		if($healer->isAlive() && $randomPlayer->isAlive()){
			$healer->healTarget($randomPlayer);
			$this->output->printHealing($healer, $randomPlayer);	
		}
	}

	private function playersAttack(){
		$this->output->printAttack($this->getPlayersTeamName());
		foreach($this->players as $player){
			if($player->isAlive()){
				$player->attack($this->enemy);

				$this->output->printDamageReceived($this->enemy, $player);
			}
		}	
	}

	public function play(){
		$attacker = $this->players;
		$this->output->printStartCombatMessage();

		while($this->anyPlayerAlive() && $this->enemy->isAlive()){
			$this->round++;
			$this->output->printRoundTitle($this->round);

			if($attacker instanceof EnemyCharacter){
				$this->enemyAttack();
			} else {
				$this->playersAttack($this->players, $this->enemy);
			}

			$attacker = $attacker == $this->enemy ? $this->players : $this->enemy;
		}

		$winnerName = $this->enemy->isAlive() ? $this->enemy->getName() : $this->getPlayersTeamName();
		$this->output->printGameOver($winnerName);
	}
}
