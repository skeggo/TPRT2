<?php
// Pokemon.php
require_once 'AttackPokemon.php';

class Pokemon
{
    protected string $name;
    protected string $imageUrl;
    protected int $hp;
    protected AttackPokemon $attackPokemon;

    public function __construct(
        string $name,
        string $imageUrl,
        int $hp,
        AttackPokemon $attackPokemon
    ) {
        $this->name = $name;
        $this->imageUrl = $imageUrl;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }

    public function getType(): string
    {
        return "Normal";
    }

    public function getName(): string
    {
        return $this->name;
    }
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }
    public function getHp(): int
    {
        return $this->hp;
    }
    public function setHp(int $hp): void
    {
        $this->hp = $hp;
    }
    public function getAttackPokemon(): AttackPokemon
    {
        return $this->attackPokemon;
    }

    public function isDead(): bool
    {
        return $this->hp <= 0;
    }

    public function attack(Pokemon $other): int
    {
        $damage = $this->attackPokemon->getDamage();
        $newHp = $other->getHp() - $damage;
        if ($newHp < 0) $newHp = 0;
        $other->setHp($newHp);

        return $damage;
    }

    public function whoAmI(): void
    {
        echo "<p>Je suis {$this->name}, j'ai {$this->hp} HP, type: {$this->getType()}, 
              <br><img src='{$this->imageUrl}' alt='pokemon' style='height:60px;'></p>";
    }
}
