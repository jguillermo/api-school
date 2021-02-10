<?php

namespace School\Student\Application\Delete;


use School\Shared\Domain\Bus\Command\Command;

class DeleteStudentByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}