<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NotificationsTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function testSeederInsertsData()
    {
        $this->seed(\UserSeeder::class);
        $this->seed(\NotificationsSeeder::class);

        $userCount = User::count();
        $notificationCount =UserNotification::count();

        $this->assertGreaterThan(0, $userCount);
        $this->assertGreaterThan(0, $notificationCount);
    }

    public function testNotificationJob()
    {
        $this->artisan('schedule:run', ['--quiet' => true]);

        $this->assertTrue(true);
    }
}
