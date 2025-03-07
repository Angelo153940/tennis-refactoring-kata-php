<?php

namespace Feature;

class TennisGame1 implements TennisGame
{
    private int $player1Score = 0;
    private int $player2Score = 0;
    private string $player1Name = '';
    private string $player2Name = '';
    private string $tanteosParciales = ["Love", "Fifteen", "Thirty", "Forty"];

    public function __construct($player1Name, $player2Name)
    {
        $this->player1Name = $player1Name;
        $this->player2Name = $player2Name;
    }

    public function wonPoint(string $playerName): void
    {
        $this->player1Name == $playerName ? $this->player1Score++ : $this->player2Score++;
    }

    public function getScore(): string
    {
        if ($this->isTie()) {
            return $this->getScoreTie();
        } 

        if($this->isAdvantage()){
            return $this->getAdvantageScore();
        }

        if($this->isWinner()){
            return $this->getWinScore();
        }

        if ($this->player1Score >= 4 || $this->player2Score >= 4) {
            $minusResult = $this->player1Score - $this->player2Score;
            if ($minusResult == 1) return "Advantage " . $this->player1Name;
            if ($minusResult == -1) return "Advantage " . $this->$player2Name;
            if ($minusResult >= 2) return "Win for " . $this->$player1Name;
            return "Win for " . $this->$player2Name;
        } 

        return $this->getScoreString($this->player1Score) . "-" . $this->getScoreString($this->player2Score);
    }

    private function isTie(): boolean
    {
        return $this->player1Score == $this->player2Score;
    }

    private function isAdvantage(): boolean
    {
        $minusResult = $this->player1Score - $this->player2Score;
        return $minusResult == 1 || $minusResult == -1;
    }

    private function isWinner(): boolean
    {
        $minusResult = $this->player1Score - $this->player2Score;
        return $minusResult == 1 || $minusResult == -1;
    }

    private function getScoreTie(): string
    {
        if($this->player1Score > 2){
            return "Deuce"; 
        }
        return $this->tanteosParciales[$this->player1Score] . "-" . "All";
    }

    private function getAdvantageScore(): string
    {
        $minusResult = $this->player1Score - $this->player2Score;
        $minusResult == 1 ? return "Advantage " . $this->player1Name : return "Advantage " . $this->$player2Name
    }

    private function getWinScore()
    {

    }

    private function getScoreString(int $score): string
    { 
        if($score > 3){
            return (string)$score;
        }
        return  $this->tanteosParciales[$score];
    }
}