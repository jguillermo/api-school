<?php

namespace App\Course\Domain;

use App\Shared\Domain\Bus\Event\DomainEvent;

final class CourseDeletedDomainEvent extends DomainEvent
{
    private $name;

    public function __construct(
        string $id,
        string $name,
        string $eventId = null,
        string $occurredOn = null
    )
    {
        parent::__construct($id, $eventId, $occurredOn);

        $this->name = $name;
    }

    public static function eventName(): string
    {
        return 'course.deleted';
    }

    public function toPrimitives(): array
    {
        return [
            'name' => $this->name,
        ];
    }

    public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): DomainEvent
    {
        return new self($aggregateId, $body['name'], $eventId, $occurredOn);
    }

    public function name(): string
    {
        return $this->name;
    }
}
