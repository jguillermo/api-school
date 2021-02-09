<?php

namespace App\Exam\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class ExamCreatedDomainEvent extends DomainEvent
{
    private $title;
    private $courseId;

    public function __construct(
        string $id,
        string $title,
        string $courseId,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);

        $this->title = $title;
        $this->courseId = $courseId;
    }

    public static function eventName(): string
    {
        return 'exam.created';
    }

    public function toPrimitives(): array
    {
        return [
            'title' => $this->title,
            'courseId' => $this->courseId,
        ];
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent
    {
        return new self($aggregateId, $body['title'],$body['courseId'], $eventId, $occurredOn);
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getCourseId(): string
    {
        return $this->courseId;
    }

}
