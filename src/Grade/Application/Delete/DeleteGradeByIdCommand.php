<?php

namespace School\Grade\Application\Delete;


use School\Shared\Domain\Bus\Command\Command;

class DeleteGradeByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}