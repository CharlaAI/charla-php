<?php

declare(strict_types=1);

namespace CharlaAI\Charla\Http\Methods\Business\v1;

use CharlaAI\Charla\Http\Methods\MethodInterface;
use CharlaAI\Charla\Response\Response;
use CharlaAI\Charla\Transport\TransportInterface;
use CharlaAI\Charla\Utils\DateUtils;
use CharlaAI\Charla\Utils\JsonResponseTrait;
use DateTimeInterface;

/**
 * Class Chat
 *
 * This class provides methods to interact with the chat API.
 * It implements the MethodInterface and uses the JsonResponseTrait for response handling.
 */
class Chat implements MethodInterface
{
    use JsonResponseTrait;

    /**
     * The base path for the chat API.
     */
    private const BASE_PATH = 'business/v1/chats/';

    /**
     * Chat constructor.
     *
     * @param TransportInterface $transport the transport to use for the HTTP methods
     */
    public function __construct(
        private TransportInterface $transport
    ) {
    }

    /**
     * Get a list of chats.
     *
     * This method retrieves a list of chats from the API.
     * It supports pagination and date range filtering.
     *
     * @param int                           $page     the page number
     * @param int                           $per_page the number of items per page
     * @param DateTimeInterface|string|null $from     the start date for the date range filter
     * @param DateTimeInterface|string|null $to       the end date for the date range filter
     *
     * @return Response the list of chats
     */
    public function list(
        int $page = 1,
        int $per_page = 10,
        DateTimeInterface|string|null $from = null,
        DateTimeInterface|string|null $to = null,
    ): Response {
        $result = $this->transport->send(
            method: TransportInterface::GET,
            path: self::BASE_PATH,
            params: [
                'page' => $page,
                'per_page' => $per_page,
                'from' => DateUtils::format($from),
                'to' => DateUtils::format($to),
            ]
        );

        return new Response($result);
    }

    /**
     * Get a chat by ID.
     *
     * This method retrieves a chat from the API by its ID.
     *
     * @param int $id the ID of the chat
     *
     * @return Response the chat data
     */
    public function get(int $id): Response
    {
        $result = $this->transport->send(
            method: TransportInterface::GET,
            path: self::BASE_PATH.$id,
        );

        return new Response($result);
    }

    /**
     * Transcribe an audio file.
     *
     * This method sends an audio file to the API for transcription.
     * It supports several options for the transcription result.
     *
     * @param resource $audio          the audio file resource
     * @param bool     $add_language   whether to add language to the transcription result
     * @param bool     $diarize        whether to split the dialogues by speakers
     * @param bool     $with_timestamp whether to add timestamps to the transcription result
     * @param string   $format         the format of the transcription result
     *
     * @return Response the transcription result
     */
    public function transcribe(
        $audio,
        bool $add_language = false,
        bool $diarize = false,
        bool $with_timestamp = false,
        string $format = 'txt'
    ): Response {
        $result = $this->transport->send(
            method: TransportInterface::POST,
            path: self::BASE_PATH,
            params: [
                'add_language' => $add_language,
                'diarize' => $diarize,
                'with_timestamp' => $with_timestamp,
                'format' => $format,
            ],
            files: [
                'chat[audio_file_ext]' => $audio,
            ]
        );

        return new Response($result);
    }
}
