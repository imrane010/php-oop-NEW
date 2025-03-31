<?php
namespace Game;

class Battle
{
     public function startFight(Character $fighter1, Character $fighter2): string
    {
        $battleLog = "<h2>Battle Log</h2>";

        while ($fighter1->health > 0 && $fighter2->health > 0) {
            // FIGHTER 1 AANVAL
            $damage = max(0, $fighter1->attack - $fighter2->defense);
            $fighter2->health -= $damage;
            $battleLog .= "<p>{$fighter1->name} attacks {$fighter2->name} for $damage damage!</p>";

            if ($fighter2->health <= 0) {
                $battleLog .= "<p>{$fighter2->name} has been defeated!</p>";
                break;
            }

            // FIGHTER 2 AANVAL
            $damage = max(0, $fighter2->attack - $fighter1->defense);
            $fighter1->health -= $damage;
            $battleLog .= "<p>{$fighter2->name} attacks {$fighter1->name} for $damage damage!</p>";

            if ($fighter1->health <= 0) {
                $battleLog .= "<p>{$fighter1->name} has been defeated!</p>";
                break;
            }
        }

        return $battleLog;
    }
}


    public function startFight(Character $fighter1, Character $fighter2): string
    {
        $battleLog = "<h2>Battle Log</h2>";

        while ($fighter1->health > 0 && $fighter2->health > 0) {
            // FIGHTER 1 AANVAL
            $damage = max(0, $fighter1->attack - $fighter2->defense);
            $fighter2->health -= $damage;
            $battleLog .= "<p>{$fighter1->name} attacks {$fighter2->name} for $damage damage!</p>";

            if ($fighter2->health <= 0) {
                $battleLog .= "<p>{$fighter2->name} has been defeated!</p>";
                break;
            }

            // FIGHTER 2 AANVAL
            $damage = max(0, $fighter2->attack - $fighter1->defense);
            $fighter1->health -= $damage;
            $battleLog .= "<p>{$fighter2->name} attacks {$fighter1->name} for $damage damage!</p>";

            if ($fighter1->health <= 0) {
                $battleLog .= "<p>{$fighter1->name} has been defeated!</p>";
                break;
            }
        }

        return $battleLog;
    }


?>
