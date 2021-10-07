<?php

namespace raff312\ticTacToe\View;

    use function cli\prompt;
    use function cli\line;
    use function cli\out;

function showGameBoard($board)
{
    $boardArr = $board->getBoardArr();
    $dim = $board->getDimension();
    for ($i = 0; $i < $dim; $i++) {
        for ($j = 0; $j < $dim; $j++) {
            $tempVar = $boardArr[$i][$j];
            out("|$tempVar");
            if ($j === ($dim - 1)) {
                out("|");
            }
        }
        line();
    }

    line("-------------------------------------------");
}

function showGamesInfoList($list)
{
    foreach ($list as $value) {
        line("\nID: $value->id\nBoard size: $value->size\nDate: $value->date\nPlayer name: $value->name\nPlayer markup: $value->playerMarkup\nWinner markup: $value->winnerMarkup");
    }
}

function showMessage($msg)
{
    line($msg);
}

function getValue($msg)
{
    return prompt($msg);
}
