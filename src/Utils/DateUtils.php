<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Utils;

use DateTimeInterface;

/**
 * Class DateUtils
 *
 * This class provides a utility method to format a DateTimeInterface object into a string.
 */
final class DateUtils
{
    /**
     * The format to be used for the date.
     */
    private const DATE_FORMAT = 'Y-m-d';

    /**
     * Format a DateTimeInterface object into a string.
     *
     * @param DateTimeInterface|string|null $dateTime the DateTimeInterface object to format
     *
     * @return string|null the formatted date string, or null if the input is not a DateTimeInterface object
     */
    public static function format(DateTimeInterface|string|null $dateTime): ?string
    {
        if ($dateTime instanceof DateTimeInterface) {
            return $dateTime->format(self::DATE_FORMAT);
        }

        return null;
    }
}
