<?php 

require 'vendor/autoload.php';

use App\Tank;
use App\DamageDealer;
use App\Healer;
use App\EnemyCharacter;
use App\Game;
use App\HTMLCombatOutput;


$playerTank 	= new Tank('Tank', 140, 7);
$playerDPS 		= new DamageDealer('DPS', 100, 15);
$playerHealer 	= new Healer('Healer', 100, 10);
$enemy 			= new EnemyCharacter('Enemy', 500, 20);

$HTMLCombatOutput = new HTMLCombatOutput();

$game = new Game($HTMLCombatOutput);
$game->addPlayer($playerTank);
$game->addPlayer($playerDPS);
$game->addPlayer($playerHealer);
$game->setPlayersTeamName('Players');
$game->setEnemy($enemy);
$game->play();

