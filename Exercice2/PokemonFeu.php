<?php
// PokemonFeu.php

require_once 'Pokemon.php';

class PokemonFeu extends Pokemon
{
    public function getType(): string
    {
        return "Feu";
    }

    public function attack(Pokemon $other): int
    {
        $baseDamage = $this->attackPokemon->getDamage();

        $multiplier = 1.0;
        $otherType = $other->getType();

        if ($otherType === "Plante") {
            $multiplier = 2.0;
        } elseif ($otherType === "Feu" || $otherType === "Eau") {
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
