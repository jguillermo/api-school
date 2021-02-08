<?php

declare(strict_types = 1);

namespace App\Tests\Shared\Infrastructure\PhpUnit;



use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\Matcher\MatcherAbstract;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }
}
