<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserNotification;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $users = User::pluck('id')->toArray();

        for ($i = 0; $i< count($users); $i++) {
            $user_id = $faker->randomElement($users);
            $user = User::find($user_id);
            $user_timezone = $user->getTimezone();
            $scheduled_time = Carbon::createFromFormat('H:i', $faker->time('H:i'))
                ->setTimezone($user_timezone)
                ->format('H:i');
            $frequency = $faker->randomElement(['daily', 'weekly', 'monthly', 'custom']);

            UserNotification::insert([
                'user_id' => $user_id,
                'scheduled_at' => $scheduled_time,
                'frequency' => $frequency,
                'notification_message' => "Hello ".$user->name.",\n\nThis is a notification for you. Your email address is: ".$user->email.".\nYou have a scheduled event at ". $scheduled_time." in your local timezone.\n\nThank you for using our notification system.\n\nBest regards,\nDemo Company",
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
