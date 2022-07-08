<?php

namespace App;

use App\Interface\CharacterInterface;
use App\Abstract\GenericCharacter;

class PlayerCharacter extends GenericCharacter implements CharacterInterface {
	const DAMAGE_VARIATION = 10;
}