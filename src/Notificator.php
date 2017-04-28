<?php

namespace Lloople\Notificator;

/**
 * Class Notificator
 *
 * @package Lloople\Notificator
 */
class Notificator
{

    /**
     * @param string $message
     * @param int $duration
     */
    public static function success(string $message, int $duration = 5000)
    {

        self::createNotification('success', $message, $duration);
    }

    /**
     * @param string $type
     * @param string $message
     * @param int $duration
     */
    public static function createNotification(string $type, string $message, int $duration)
    {

        $notification = new NotificatorMessage($type, $message, $duration);

        session()->flash('notifications.' . $notification->getId(), $notification);
    }

    /**
     * @param string $message
     * @param int $duration
     */
    public static function warning(string $message, int $duration = 5000)
    {

        self::createNotification('warning', $message, $duration);
    }

    /**
     * @param string $message
     * @param int $duration
     */
    public static function info(string $message, int $duration = 5000)
    {

        self::createNotification('info', $message, $duration);
    }

    /**
     * @param string $message
     * @param int $duration
     */
    public static function error(string $message, int $duration = 5000)
    {

        self::createNotification('error', $message, $duration);
    }
}