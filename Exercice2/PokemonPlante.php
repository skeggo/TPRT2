<?php
// PokemonPlante.php

require_once 'Pokemon.php';

class PokemonPlante extends Pokemon
{
    public function getType(): string
    {
        return "Plante";
    }

    public function attack(Pokemon $other): int
    {
        $baseDamage = $this->attackPokemon->getDamage();

        $multiplier = 1.0;
        $otherType = $other->getType();

        if ($otherType === "Eau") {
            $multiplier = 2.0;
        } elseif ($otherType === "Plante" || $otherType === "Feu") {
            $multiplier = 0.5;
        }

        $damage = (int) round($baseDamage * $multiplier);

        $newHp = $other->getHp() - $damage;
        if ($newHp < 0) {
            $newHp = 0;
        }
        $other->setHp($newHp);

        return $damage;
    }
}
