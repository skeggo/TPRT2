<?php
// fight_types.php

require_once 'AttackPokemon.php';
require_once 'Pokemon.php';
require_once 'PokemonFeu.php';
require_once 'PokemonEau.php';
require_once 'PokemonPlante.php';

$pokemonFeu = new PokemonFeu(
    "Salamèche",
    "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png",
    80,
    new AttackPokemon(5, 10, 2.0, 30)
);

$pokemonEau = new PokemonEau(
    "Carapuce",
    "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/7.png",
    80,
    new AttackPokemon(5, 10, 2.0, 30)
);

$rounds = [];
$roundNumber = 1;

while (!$pokemonFeu->isDead() && !$pokemonEau->isDead()) {
    $damageFeu = $pokemonFeu->attack($pokemonEau);

    if ($pokemonEau->isDead()) {
        $rounds[] = [
            'round'      => $roundNumber,
            'damageFeu'  => $damageFeu,
            'damageEau'  => null,
            'hpFeu'      => $pokemonFeu->getHp(),
            'hpEau'      => $pokemonEau->getHp()
        ];
        break;
    }
    $damageEau = $pokemonEau->attack($pokemonFeu);

    $rounds[] = [
        'round'     => $roundNumber,
        'damageFeu' => $damageFeu,
        'damageEau' => $damageEau,
        'hpFeu'     => $pokemonFeu->getHp(),
        'hpEau'     => $pokemonEau->getHp()
    ];

    $roundNumber++;
}

$winner = null;
if (!$pokemonFeu->isDead() && $pokemonEau->isDead()) {
    $winner = $pokemonFeu;
} elseif (!$pokemonEau->isDead() && $pokemonFeu->isDead()) {
    $winner = $pokemonEau;
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat Pokémon (Types)</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="title">Combat entre Types (Feu vs. Eau)</h1>

<!-- Presentation: Points initiaux + stats -->
<div class="pokemon-container">
    <div class="pokemon-box">
        <img src="<?= $pokemonFeu->getImageUrl() ?>" alt="pokemonFeu" class="pokemon-img">
        <h2><?= $pokemonFeu->getName() ?> (<?= $pokemonFeu->getType() ?>)</h2>
        <ul>
            <li><strong>Points initiaux :</strong> 80</li>
            <li><strong>Min Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getAttackMinimal() ?></li>
            <li><strong>Max Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getAttackMaximal() ?></li>
            <li><strong>Special Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getSpecialAttack() ?></li>
            <li><strong>Probability Special Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
        </ul>
    </div>

    <div class="pokemon-box">
        <img src="<?= $pokemonEau->getImageUrl() ?>" alt="pokemonEau" class="pokemon-img">
        <h2><?= $pokemonEau->getName() ?> (<?= $pokemonEau->getType() ?>)</h2>
        <ul>
            <li><strong>Points initiaux :</strong> 80</li>
            <li><strong>Min Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getAttackMinimal() ?></li>
            <li><strong>Max Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getAttackMaximal() ?></li>
            <li><strong>Special Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getSpecialAttack() ?></li>
            <li><strong>Probability Special Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
        </ul>
    </div>
</div>

<!-- Display round by round -->
<?php foreach ($rounds as $roundData): ?>
    <div class="round-box">
        <h3>Round <?= $roundData['round'] ?></h3>
        <div class="damage-box">
            <div><?= $roundData['damageFeu'] !== null ? $roundData['damageFeu'] : '-' ?></div>
            <div><?= $roundData['damageEau'] !== null ? $roundData['damageEau'] : '-' ?></div>
        </div>
    </div>

    <div class="pokemon-container">
        <div class="pokemon-box">
            <img src="<?= $pokemonFeu->getImageUrl() ?>" alt="pokemonFeu" class="pokemon-img">
            <h2><?= $pokemonFeu->getName() ?> (<?= $pokemonFeu->getType() ?>)</h2>
            <ul>
                <li><strong>Points après Round <?= $roundData['round'] ?> :</strong> <?= $roundData['hpFeu'] ?></li>
                <li><strong>Min Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getAttackMinimal() ?></li>
                <li><strong>Max Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getAttackMaximal() ?></li>
                <li><strong>Special Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getSpecialAttack() ?></li>
                <li><strong>Probability Special Attack :</strong> <?= $pokemonFeu->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
            </ul>
        </div>

        <div class="pokemon-box">
            <img src="<?= $pokemonEau->getImageUrl() ?>" alt="pokemonEau" class="pokemon-img">
            <h2><?= $pokemonEau->getName() ?> (<?= $pokemonEau->getType() ?>)</h2>
            <ul>
                <li><strong>Points après Round <?= $roundData['round'] ?> :</strong> <?= $roundData['hpEau'] ?></li>
                <li><strong>Min Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getAttackMinimal() ?></li>
                <li><strong>Max Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getAttackMaximal() ?></li>
                <li><strong>Special Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getSpecialAttack() ?></li>
                <li><strong>Probability Special Attack :</strong> <?= $pokemonEau->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>

<!-- Winner box -->
<?php if ($winner !== null): ?>
    <div class="winner-box">
        <h2>Le vainqueur est</h2>
        <img src="<?= $winner->getImageUrl() ?>" alt="winner" class="winner-img">
    </div>
<?php else: ?>
    <div class="winner-box">
        <h2>Match nul !</h2>
    </div>
<?php endif; ?>

</body>
</html>
