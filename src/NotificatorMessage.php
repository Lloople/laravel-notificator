<?php

namespace Lloople\Notificator;

class NotificatorMessage
{

    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     */
    private $duration;

    /**
     * @var string
     */
    private $id;

    /**
     * NotificatorMessage constructor.
     *
     * @param string $type
     * @param string $message
     * @param int $duration
     */
    public function __construct(string $type, string $message, int $duration)
    {
        $this->id = uniqid();
        $this->type = $type;
        $this->message = $message;
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getType(): string { return $this->type; }

    /**
     * @return string
     */
    public function getMessage(): string { return $this->message; }

    /**
     * @return int
     */
    public function getDuration(): int { return $this->duration; }

    /**
     * @return string
     */
    public function getId(): string { return $this->id; }

    /**
     * @return string
     */
    public function getBootstrapClass(): string
    {
        return $this->type == 'error' ? 'danger' : $this->type;
    }

    public function toArray(): array
    {
        return [
            'type' => $this->getType(),
            'id' => $this->getId(),
            'message' => $this->getMessage(),
            'duration' => $this->getDuration()
        ];
    }
}