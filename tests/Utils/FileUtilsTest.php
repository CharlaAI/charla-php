<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Tests\Utils;

use CharlaAI\Charla\Utils\FileUtils;
use GuzzleHttp\Psr7\MultipartStream;
use PHPUnit\Framework\TestCase;

class FileUtilsTest extends TestCase
{
    public function testMultipartStreamIsCreatedFromFiles(): void
    {
        $files = [
            'file1' => tmpfile(),
            'file2' => tmpfile(),
        ];

        $multipartStream = FileUtils::toMultipartStream($files);

        $this->assertInstanceOf(MultipartStream::class, $multipartStream);
    }

    public function testMultipartStreamIsEmptyForNoFiles(): void
    {
        $files = [];

        $multipartStream = FileUtils::toMultipartStream($files);

        $this->assertSame(46, $multipartStream->getSize());
    }
}
