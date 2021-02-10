<?php

namespace App\Grade\Application\Delete;


use App\Shared\Domain\Bus\Command\Command;

class DeleteGradeByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}