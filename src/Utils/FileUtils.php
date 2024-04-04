<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Utils;

use GuzzleHttp\Psr7\MultipartStream;

/**
 * Class FileUtils
 *
 * This class provides a method to convert an array of files into a MultipartStream.
 */
final class FileUtils
{
    /**
     * Convert an array of files into a MultipartStream.
     *
     * @param array<string, resource> $files the array of files to convert
     *
     * @return MultipartStream the converted MultipartStream
     */
    public static function toMultipartStream(array $files): MultipartStream
    {
        $preparedFiles = [];
        foreach ($files as $name => $resource) {
            $preparedFiles[] = [
                'name' => $name,
                'contents' => $resource,
            ];
        }

        return new MultipartStream($preparedFiles);
    }
}
