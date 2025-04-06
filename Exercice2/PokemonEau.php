<?php
// PokemonEau.php

require_once 'Pokemon.php';

class PokemonEau extends Pokemon
{
    public function getType(): string
    {
        return "Eau";
    }

    public function attack(Pokemon $other): int
    {
        $baseDamage = $this->attackPokemon->getDamage();

        $multiplier = 1.0;
        $otherType = $other->getType();

        if ($otherType === "Feu") {
            $multiplier = 2.0;
        } elseif ($otherType === "Eau" || $otherType === "Plante") {
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
