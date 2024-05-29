<?php

namespace App\Models;

use App\DB;
use Generator;
use PDOStatement;

class Model
{

    public function __construct(protected DB $db)
    {
    }

    public function fetchLazy(PDOStatement $stmt): Generator
    {
        foreach($stmt as $record) {
            yield $record;
        }
    }
}