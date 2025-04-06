<?php
// index.php

require_once 'Pokemon.php'; 

$pokemon1 = new Pokemon(
    "Dracaufeu (Orange)",
    "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/6.png",
    200,
    new AttackPokemon(10, 100, 2.0, 20)
);

$pokemon2 = new Pokemon(
    "Dracaufeu (Blue)",
    "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/10034.png",
    200,
    new AttackPokemon(30, 80, 4.0, 20)
);

$rounds = [];
$roundNumber = 1;

while (!$pokemon1->isDead() && !$pokemon2->isDead()) {
    // Pokémon1 attacks
    $damage1 = $pokemon1->attack($pokemon2);

    if ($pokemon2->isDead()) {
        // Save data
        $rounds[] = [
            'round'    => $roundNumber,
            'damageP1' => $damage1,
            'damageP2' => null,
            'hp1'      => $pokemon1->getHp(),
            'hp2'      => $pokemon2->getHp(),
        ];
        break;
    }
// Pokémon2 attacks
    $damage2 = $pokemon2->attack($pokemon1);

    // Save data
    $rounds[] = [
        'round'    => $roundNumber,
        'damageP1' => $damage1,
        'damageP2' => $damage2,
        'hp1'      => $pokemon1->getHp(),
        'hp2'      => $pokemon2->getHp(),
    ];

    $roundNumber++;
}

// Determine winner
$winner = null;
if (!$pokemon1->isDead() && $pokemon2->isDead()) {
    $winner = $pokemon1;
} elseif (!$pokemon2->isDead() && $pokemon1->isDead()) {
    $winner = $pokemon2;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Combat Pokémon</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1 class="title">Les combattants</h1>

<!-- Initial presentation -->
<div class="pokemon-container">
    <div class="pokemon-box">
        <img src="<?= $pokemon1->getImageUrl() ?>" alt="pokemon1" class="pokemon-img">
        <h2><?= $pokemon1->getName() ?></h2>
        <ul>
            <li><strong>Points initiaux :</strong> 200</li>
            <li><strong>Min Attack Points :</strong> <?= $pokemon1->getAttackPokemon()->getAttackMinimal() ?></li>
            <li><strong>Max Attack Points :</strong> <?= $pokemon1->getAttackPokemon()->getAttackMaximal() ?></li>
            <li><strong>Special Attack :</strong> <?= $pokemon1->getAttackPokemon()->getSpecialAttack() ?></li>
            <li><strong>Probability Special Attack :</strong> <?= $pokemon1->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
        </ul>
    </div>

    <div class="pokemon-box">
        <img src="<?= $pokemon2->getImageUrl() ?>" alt="pokemon2" class="pokemon-img">
        <h2><?= $pokemon2->getName() ?></h2>
        <ul>
            <li><strong>Points initiaux :</strong> 200</li>
            <li><strong>Min Attack Points :</strong> <?= $pokemon2->getAttackPokemon()->getAttackMinimal() ?></li>
            <li><strong>Max Attack Points :</strong> <?= $pokemon2->getAttackPokemon()->getAttackMaximal() ?></li>
            <li><strong>Special Attack :</strong> <?= $pokemon2->getAttackPokemon()->getSpecialAttack() ?></li>
            <li><strong>Probability Special Attack :</strong> <?= $pokemon2->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
        </ul>
    </div>
</div>

<?php foreach ($rounds as $roundData): ?>
    <div class="round-box">
        <h3>Round <?= $roundData['round'] ?></h3>
        <div class="damage-box">
            <!-- Damage from Pokémon1 -->
            <div><?= $roundData['damageP1'] !== null ? $roundData['damageP1'] : '-' ?></div>
            <!-- Damage from Pokémon2 -->
            <div><?= $roundData['damageP2'] !== null ? $roundData['damageP2'] : '-' ?></div>
        </div>
    </div>
    <div class="pokemon-container">
        <div class="pokemon-box">
            <img src="<?= $pokemon1->getImageUrl() ?>" alt="pokemon1" class="pokemon-img">
            <h2><?= $pokemon1->getName() ?></h2>
            <ul>
                <li><strong>Points après Round <?= $roundData['round'] ?> :</strong> <?= $roundData['hp1'] ?></li>
                <li><strong>Min Attack Points :</strong> <?= $pokemon1->getAttackPokemon()->getAttackMinimal() ?></li>
                <li><strong>Max Attack Points :</strong> <?= $pokemon1->getAttackPokemon()->getAttackMaximal() ?></li>
                <li><strong>Special Attack :</strong> <?= $pokemon1->getAttackPokemon()->getSpecialAttack() ?></li>
                <li><strong>Probability Special Attack :</strong> <?= $pokemon1->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
            </ul>
        </div>

        <div class="pokemon-box">
            <img src="<?= $pokemon2->getImageUrl() ?>" alt="pokemon2" class="pokemon-img">
            <h2><?= $pokemon2->getName() ?></h2>
            <ul>
                <li><strong>Points après Round <?= $roundData['round'] ?> :</strong> <?= $roundData['hp2'] ?></li>
                <li><strong>Min Attack Points :</strong> <?= $pokemon2->getAttackPokemon()->getAttackMinimal() ?></li>
                <li><strong>Max Attack Points :</strong> <?= $pokemon2->getAttackPokemon()->getAttackMaximal() ?></li>
                <li><strong>Special Attack :</strong> <?= $pokemon2->getAttackPokemon()->getSpecialAttack() ?></li>
                <li><strong>Probability Special Attack :</strong> <?= $pokemon2->getAttackPokemon()->getProbabilitySpecialAttack() ?></li>
            </ul>
        </div>
    </div>
<?php endforeach; ?>

<!-- Final winner -->
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
