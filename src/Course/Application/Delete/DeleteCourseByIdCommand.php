<?php

namespace App\Course\Application\Delete;


use App\Shared\Domain\Bus\Command\Command;

class DeleteCourseByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}