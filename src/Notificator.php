<?php

namespace Lloople\Notificator;

/**
 * Class Notificator
 *
 * @package Lloople\Notificator
 */
class Notificator
{

    public static function success(string $message, int $duration = 5000)
    {

        self::createNotification('success', $message, $duration);
    }

    public static function createNotification(string $type, string $message, int $duration)
    {

        $notification = new NotificatorMessage($type, $message, $duration);

        session()->flash('notifications.' . $notification->getId(), $notification);
    }

    public static function getUniqueId(): string
    {

        return uniqid();
    }

    public static function warning(string $message, int $duration = 5000)
    {

        self::createNotification('warning', $message, $duration);
    }

    public static function info(string $message, int $duration = 5000)
    {

        self::createNotification('info', $message, $duration);
    }

    public static function error(string $message, int $duration = 5000)
    {

        self::createNotification('error', $message, $duration);
    }
}