<?php


namespace Lloople\Notificator;


/**
 * Class NotificatorMessage
 *
 * @package Lloople\Notificator
 */
class NotificatorMessage
{

    private $type;
    private $message;
    private $duration;
    private $id;
    public function __construct(string $type, string $message, int $duration)
    {
        $this->id = uniqid();
        $this->type = $type;
        $this->message = $message;
        $this->duration = $duration;
    }

    public function getType(): string { return $this->type; }

    public function getMessage(): string { return $this->message; }

    public function getDuration(): int { return $this->duration; }

    public function getId(): string { return $this->id; }

    public function getBootstrapClass()
    {
        return $this->type == 'error' ? 'danger' : $this->type;
    }
}