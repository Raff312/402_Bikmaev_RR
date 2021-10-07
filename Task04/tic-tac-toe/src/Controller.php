<?php

namespace raff312\ticTacToe\Controller;

use Exception as Exception;
use raff312\ticTacToe\Model\Board as Board;
use raff312\ticTacToe\Repositories\GamesRepository as GamesRepository;

use function raff312\ticTacToe\View\showGameBoard;
use function raff312\ticTacToe\View\showGamesInfoList;
use function raff312\ticTacToe\View\showMessage;
use function raff312\ticTacToe\View\getValue;

use const raff312\ticTacToe\Model\PLAYER_X_MARKUP;

function startGame($argv)
{
    if (count($argv) <= 1 || $argv[1] === "--new" || $argv[1] === "-n") {
        startGameInternal();
    } else if ($argv[1] === "--list" || $argv[1] === "-l") {
        listInfo();
    } else if ($argv[1] === "--replay" || $argv[1] === "-r") {
        showMessage("replay");
    } else if ($argv[1] === "--help" || $argv[1] === "-h") {
        showMessage("help");
    } else {
        showMessage("Unknown argument!");
    }
}

function startGameInternal() {
    $canContinue = true;
    do {
        $gameBoard = new Board();
        initialize($gameBoard);
        gameLoop($gameBoard);
        inviteToContinue($canContinue);
    } while ($canContinue);
}

function initialize($board)
{
    try {
        $board->setDimension(getValue("Enter game board size"));
        $board->initialize();
    } catch (Exception $e) {
        showMessage($e->getMessage());
        initialize($board);
    }
}

function gameLoop($board)
{
    $stopGame = false;
    $winnerMarkup = PLAYER_X_MARKUP;
    $currentMarkup = PLAYER_X_MARKUP;
    $endGameMsg = "";

    do {
        showGameBoard($board);

        $winnerMarkup = $currentMarkup;
        if ($currentMarkup == $board->getUserMarkup()) {
            processUserTurn($board, $currentMarkup, $stopGame);
            $endGameMsg = "Player '$currentMarkup' wins the game.";
            $currentMarkup = $board->getComputerMarkup();
        } else {
            processComputerTurn($board, $currentMarkup, $stopGame);
            $endGameMsg = "Player '$currentMarkup' wins the game.";
            $currentMarkup = $board->getUserMarkup();
        }

        if (!$board->isFreeSpaceEnough() && !$stopGame) {
            showGameBoard($board);
            $endGameMsg = "Draw!";
            $winnerMarkup = "Draw";
            $stopGame = true;
        }
    } while (!$stopGame);

    showGameBoard($board);
    showMessage($endGameMsg);

    $gamesRepository = new GamesRepository();
    $gamesRepository->add($board, $winnerMarkup);
}

function processUserTurn($board, $markup, &$stopGame)
{
    $answerTaked = false;
    do {
        try {
            $coords = getCoords($board);
            $board->setMarkupOnBoard($coords[0], $coords[1], $markup);
            if ($board->determineWinner($coords[0], $coords[1]) !== "") {
                $stopGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
            showMessage($e->getMessage());
        }
    } while (!$answerTaked);
}

function getCoords($board)
{
    $markup = $board->getUserMarkup();
    $coords = getValue("Enter coords for player '$markup'");
    $coords = explode(" ", $coords);
    return $coords;
}

function processComputerTurn($board, $markup, &$stopGame)
{
    $answerTaked = false;
    do {
        $i = rand(0, $board->getDimension() - 1);
        $j = rand(0, $board->getDimension() - 1);
        try {
            $board->setMarkupOnBoard($i, $j, $markup);
            if ($board->determineWinner($i, $j) !== "") {
                $stopGame = true;
            }

            $answerTaked = true;
        } catch (Exception $e) {
        }
    } while (!$answerTaked);
}

function inviteToContinue(&$canContinue)
{
    $answer = "";
    do {
        $answer = strtolower(getValue("Do you want to continue? (y/n)"));
        if ($answer === "y") {
            $canContinue = true;
        } elseif ($answer === "n") {
            $canContinue = false;
        }
    } while ($answer !== "y" && $answer !== "n");
}

function listInfo()
{
    $gamesRepository = new GamesRepository();
    $infoList = $gamesRepository->getAll();
    showGamesInfoList($infoList);
}
