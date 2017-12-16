<?php

namespace Tests;

use Lloople\Notificator\Notificator;
use Lloople\Notificator\NotificatorMessage;
use Orchestra\Testbench\TestCase;


class NotificatorTest extends TestCase
{

    /** @test */
    public function can_find_notification_by_id()
    {
        $id = Notificator::info('notification');

        $message = Notificator::find($id);

        $this->assertNotNull($message);

        $this->assertInstanceOf(NotificatorMessage::class, $message);
    }

    /** @test */
    public function can_get_all_notifications_as_array()
    {
        $this->assertCount(0, Notificator::all());

        Notificator::success('ok');
        Notificator::error('ko');

        $this->assertInternalType('array', Notificator::all());

        $this->assertCount(2, Notificator::all());
    }

    /** @test */
    public function can_get_the_first_notification()
    {
        Notificator::success('ok');

        $this->assertInstanceOf(NotificatorMessage::class, Notificator::first());

        $this->assertEquals('ok', Notificator::first()->getMessage());
    }

    /** @test */
    public function first_notification_returns_null_if_there_is_no_notification()
    {
        $this->assertNull(Notificator::first());
    }

    /** @test */
    public function can_add_a_success_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Notificator::success('user created');

        $notification = Notificator::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(NotificatorMessage::class, $notification);

        $this->assertEquals('user created', $notification->getMessage());

        $this->assertEquals('success', $notification->getType());
    }

    /** @test */
    public function can_add_a_error_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Notificator::error('forbidden access');

        $notification = Notificator::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(NotificatorMessage::class, $notification);

        $this->assertEquals('forbidden access', $notification->getMessage());

        $this->assertEquals('error', $notification->getType());
    }

    /** @test */
    public function can_add_a_info_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Notificator::info('you have a new email');

        $notification = Notificator::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(NotificatorMessage::class, $notification);

        $this->assertEquals('you have a new email', $notification->getMessage());

        $this->assertEquals('info', $notification->getType());
    }

    /** @test */
    public function can_add_a_warning_notification()
    {
        $this->assertEmpty(session('notifications'));

        $notificationId = Notificator::warning('your account will be closed in 2 days');

        $notification = Notificator::find($notificationId);

        $this->assertEquals(1, count(session('notifications')));

        $this->assertInstanceOf(NotificatorMessage::class, $notification);

        $this->assertEquals('your account will be closed in 2 days', $notification->getMessage());

        $this->assertEquals('warning', $notification->getType());
    }

    /** @test */
    public function can_check_if_session_has_notifications()
    {
        Notificator::warning('A notification about nothing');

        $this->assertTrue(Notificator::any());
    }

    /** @test */
    public function can_return_notifications_as_array()
    {
        Notificator::warning('A notification about nothing');

        $array = Notificator::toArray();

        $this->assertCount(1, $array);

        $this->assertEquals('warning', $array[0]['type']);
    }
}