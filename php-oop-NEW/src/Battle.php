<?php

namespace Game;

use Game\Character;

/**
 * Deze class voert een gevecht uit tussen twee characters.
 */
class Battle
{
    private string $battleLog = '';
    private int $maxRounds = 10;
    private int $roundNumber = 1;

    public function getBattleLog(): string
    {
        return $this->battleLog;
    }

    public function getMaxRounds(): int
    {
        return $this->maxRounds;
    }

    public function getRoundNumber(): int
    {
        return $this->roundNumber;
    }

    public function changeMaxRounds(int $rounds): void
    {
        $this->maxRounds = $rounds;
    }

    public function startFight(Character $fighter1, Character $fighter2): string
    {
        while (
            $fighter1->getHealth() > 0 &&
            $fighter2->getHealth() > 0 &&
            $this->roundNumber <= $this->maxRounds
        ) {
            // beurt fighter1 → fighter2
            $damage = $this->calculateDamage($fighter1, $fighter2);
            $fighter2->takeDamage($damage);
            $this->logAttack($fighter1, $fighter2, $damage);

            if ($fighter2->getHealth() <= 0) break;

            // beurt fighter2 → fighter1
            $damage = $this->calculateDamage($fighter2, $fighter1);
            $fighter1->takeDamage($damage);
            $this->logAttack($fighter2, $fighter1, $damage);

            $this->roundNumber++;
        }

        if ($fighter1->getHealth() <= 0) {
            $this->battleLog .= "{$fighter2->getName()} heeft gewonnen!\n";
            return "{$fighter2->getName()} wint!";
        } elseif ($fighter2->getHealth() <= 0) {
            $this->battleLog .= "{$fighter1->getName()} heeft gewonnen!\n";
            return "{$fighter1->getName()} wint!";
        } else {
            $this->battleLog .= "Het maximale aantal rondes is bereikt.\n";
            return "Geen winnaar na {$this->maxRounds} rondes.";
        }
    }

    /**
     * Berekent de schade van een aanval.
     *
     * @param Character $attacker
     * @param Character $defender
     * @return int
     */
    private function calculateDamage(Character $attacker, Character $defender): int
    {
        $randomFactor = rand(70, 100) / 100; // 70% tot 100%
        $rawDamage = $attacker->getAttack() * $randomFactor;
        $damage = max(0, round($rawDamage - $defender->getDefense()));

        return (int)$damage;
    }

    /**
     * Voegt een aanval toe aan het gevechtsverslag.
     *
     * @param Character $attacker
     * @param Character $defender
     * @param int $damage
     */
    private function logAttack(Character $attacker, Character $defender, int $damage): void
    {
        $this->battleLog .= "{$attacker->getName()} valt {$defender->getName()} aan en doet {$damage} schade.\n";
    }
}
