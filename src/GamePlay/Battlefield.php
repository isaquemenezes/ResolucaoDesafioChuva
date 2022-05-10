<?php

namespace Play;

use Playcountry\CountryInterface;

/**
 * Um gerente que vai rolar os dados e calcular os vencedores de uma batalha.
 */
class Battlefield implements BattlefieldInterface {

   

    public function rollDice(CountryInterface $country, bool $isAttacking): array
    {
        $dicesNumbers = [];

        $numberOfTroops = !$isAttacking ? $country->getNumberOfTroops() : $country->getNumberOfTroops() - 1;

        for ($i = 0; $i < $numberOfTroops; $i++){
            $dicesNumbers[] = rand(1, 6) ;
        }

        rsort($dicesNumbers);

        return $dicesNumbers;
    }

    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void
    {
        $attackingDiceLength = count($attackingDice);
        $defendingDiceLength = count($defendingDice);

        $minDicesNumbers = min($attackingDiceLength, $defendingDiceLength);

        $killedTroopsAttacking = 0;
        $killedTroopsDefending = 0;

        for ($i = 0; $i < $minDicesNumbers; $i++){
            if ($attackingDice[$i] > $defendingDice[$i]){
                $killedTroopsDefending++;
            }
            if ($defendingDice[$i] > $attackingDice[$i]){
                $killedTroopsAttacking++;
            }
        }

        $attackingCountry->killTroops($killedTroopsAttacking);
        $defendingCountry->killTroops($killedTroopsDefending);
    }

    //op 2
    public function rollDice(CountryInterface $country, bool $isAtacking): array
    {
        $dice = [];
        if($isAtacking){
            for($i=0;$i < $country -> getNumberOfTroops()-1;$i++ ){
                $dice[$i] = rand(1,6);
            }
        }else{
            for($i=0;$i < $country ->getNumberOfTroops(); $i++){
                $dice[$i]= rand(1,6);
            }
        }

        return $dice;
    }

    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void
    {
        $attackingDiceOrdened = arsort($attackingDice);
        $defendingDiceOrdened = arsort($defendingDice);

        if(count($attackingDice) >= count($defendingDice)){
            for($i=0;$i < $defendingDice;$i++){
               if($attackingDiceOrdened[$i] > $defendingDiceOrdened[$i] ){
                    $defendingCountry ->killTroops(1);

               }else{
                    $attackingCountry ->killTroops(1);

               }
            }

        }

    }

    //Op 3

    public function rollDice(CountryInterface $country, bool $isAtacking) : array {
        $diceResult=[];
        
        if($isAtacking){
            $diceTroops = $country->getNumberOfTroops() -1;
        }else{
            $diceTroops = $country->getNumberOfTroops();
        }

        for($j = 1; $j <= $diceTroops; $j++ ){
            array_push($diceResult, rand(1,6));
        }

        rsort($diceResult);

        return $diceResult;
    }

    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void {
        if( count($attackingDice) <= count($defendingDice) ){
            $maxSets=count($attackingDice);
        }else{
            $maxSets=count($defendingDice);
        }
        for( $k = 0 ; $k < $maxSets ; $k++ ){
            if( $attackingDice[$k] > $defendingDice[$k] ){
                $defendingCountry->killTroops(1);
            }else{
                $attackingCountry->killTroops(1);
            }
        }
    }

}
