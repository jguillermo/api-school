<?php

namespace School\Course\Application\Delete;


use School\Shared\Domain\Bus\Command\Command;

class DeleteCourseByIdCommand implements Command
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
}