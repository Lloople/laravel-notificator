<?php

namespace Lloople\Notificator;

class Notificator
{

    const VERSION = '1.5.3';
    
    /**
     * @param string $type
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function createNotification(string $type, string $message, int $duration)
    {
        $notification = new NotificatorMessage($type, $message, $duration);

        session()->flash('notifications.' . $notification->getId(), $notification);

        return $notification->getId();
    }

    /**
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function success(string $message, int $duration = 5000)
    {
        return self::createNotification('success', $message, $duration);
    }

    /**
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function warning(string $message, int $duration = 5000)
    {
        return self::createNotification('warning', $message, $duration);
    }

    /**
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function info(string $message, int $duration = 5000)
    {
        return self::createNotification('info', $message, $duration);
    }

    /**
     * @param string $message
     * @param int $duration
     * @return string
     */
    public static function error(string $message, int $duration = 5000)
    {
        return self::createNotification('error', $message, $duration);
    }

    public static function all()
    {
        return session('notifications', []);
    }

    public static function find($id)
    {
        return session('notifications.'.$id);
    }

    public static function first()
    {
        $notifications = session('notifications');

        return $notifications ? reset($notifications) : null;
    }

    public static function any()
    {
        return session()->has('notifications');
    }

    public static function toArray()
    {
        return collect(self::all())->map(function (NotificatorMessage $notification) {
            return $notification->toArray();
        })->values();
    }
}