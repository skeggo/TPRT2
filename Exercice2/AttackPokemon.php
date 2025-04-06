<?php
// AttackPokemon.php

class AttackPokemon
{
    private int $attackMinimal;
    private int $attackMaximal;
    private float $specialAttack;
    private int $probabilitySpecialAttack;

    public function __construct(
        int $attackMinimal,
        int $attackMaximal,
        float $specialAttack,
        int $probabilitySpecialAttack
    ) {
        $this->attackMinimal = $attackMinimal;
        $this->attackMaximal = $attackMaximal;
        $this->specialAttack = $specialAttack;
        $this->probabilitySpecialAttack = $probabilitySpecialAttack;
    }

    public function getDamage(): int
    {
        $baseDamage = rand($this->attackMinimal, $this->attackMaximal);
        $random = rand(1, 100);
        if ($random <= $this->probabilitySpecialAttack) {
            // attaque spéciale
            $damage = $baseDamage * $this->specialAttack;
        } else {
            $damage = $baseDamage;
        }
        return (int) round($damage);
    }

    // Getters
    public function getAttackMinimal(): int { return $this->attackMinimal; }
    public function getAttackMaximal(): int { return $this->attackMaximal; }
    public function getSpecialAttack(): float { return $this->specialAttack; }
    public function getProbabilitySpecialAttack(): int { return $this->probabilitySpecialAttack; }
}
