<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Utils;

use CharlaAI\Charla\Utils\DateUtils;
use DateTime;
use Faker\Factory;
use PHPUnit\Framework\TestCase;

class DateUtilsTest extends TestCase
{
    private \Faker\Generator $faker;

    protected function setUp(): void
    {
        $this->faker = Factory::create();
    }

    public function testDateIsFormattedCorrectly(): void
    {
        $date = new DateTime($this->faker->date());
        $formattedDate = DateUtils::format($date);
        $this->assertSame($date->format('Y-m-d'), $formattedDate);
    }

    public function testNullIsReturnedForNullInput(): void
    {
        $formattedDate = DateUtils::format(null);
        $this->assertNull($formattedDate);
    }

    public function testNullIsReturnedForStringInput(): void
    {
        $formattedDate = DateUtils::format('not a date');
        $this->assertNull($formattedDate);
    }
}
