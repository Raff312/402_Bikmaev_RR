<?php

namespace raff312\ticTacToe\Repositories;

use SQLite3;
use raff312\ticTacToe\Model\Board as Board;
use stdClass;

const DB_PATH = "../data/games.db";

class GamesRepository
{
    private $db;

    public function __construct() {
        $this->db = new SQLite3(DB_PATH);
        $this->createTable();
    }

    private function createTable()
    {
        $gamesInfoTable = "CREATE TABLE IF NOT EXISTS gamesInfo(
            id INTEGER PRIMARY KEY,
            sizeBoard INTEGER,
            gameDate DATETIME,
            playerName TEXT,
            playerMarkup TEXT,
            winnerMarkup TEXT
        )";
        $this->db->exec($gamesInfoTable);
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function add(Board $board, $winnerMarkup)
    {
        $size = $board->getDimension();
        date_default_timezone_set("Europe/Moscow");
        $date = date("Y-m-d H:i:s");
        $playerName = getenv("username");
        $playerMarkup = $board->getUserMarkup();

        $this->db->exec("INSERT INTO gamesInfo (sizeBoard, gameDate, playerName, playerMarkup, winnerMarkup) 
            VALUES ('$size', '$date', '$playerName', '$playerMarkup', '$winnerMarkup')");
    }

    public function getAll()
    {
        $result = [];

        $query = $this->db->query("SELECT * FROM gamesInfo");
        while ($row = $query->fetchArray()) {
            $info = new stdClass();
            $info->id = $row[0];
            $info->size = $row[1];
            $info->date = $row[2];
            $info->name = $row[3];
            $info->playerMarkup = $row[4];
            $info->winnerMarkup = $row[5];
            array_push($result, $info);
        }

        return $result;
    }
}
