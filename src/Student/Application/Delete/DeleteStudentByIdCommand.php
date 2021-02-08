<?php

namespace App\Student\Application\Delete;


use App\Shared\Domain\Bus\Command\Command;

class DeleteStudentByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}