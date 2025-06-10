<?php

namespace App\Helpers;

use App\Mail\WebinarExpireMail;
use App\Models\WebinarRegistration;
use App\Mail\WebinarReminderMail;
use App\Mail\WebinarLiveMail;
use App\Mail\WebinarReplayMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class WebinarReminderHelper
{

    public static function sendReminders()
    {
        Log::info("⏰ sendReminders() function called");

        $registrations = WebinarRegistration::all();

        foreach ($registrations as $registration) {



            $now = Carbon::now('UTC');
            $slot = Carbon::parse($registration->slot);

            $diffInMinutes = $now->diffInMinutes($slot, false);

            // Log actual difference for debugging
            Log::info("User: {$registration->email}, Slot: {$slot}, Now: {$now}, Diff: {$diffInMinutes} mins");


            // Email 2 mins after registration (test mail)
            // Convert created_at to UTC before calculating difference
            // $createdAtUtc = Carbon::parse($registration->created_at)->setTimezone('UTC');
            // $minutesAfterRegistration = $now->diffInMinutes($createdAtUtc, false);

            // Log::info("kitna time hogay emial kre - Diff: {$minutesAfterRegistration} mins created at {$createdAtUtc}");

            // if ($minutesAfterRegistration == -1) {
            //     Log::info("✅ Sending test mail to: " . $registration->email);
            //     Mail::to($registration->email)->send(
            //         new WebinarReminderMail($registration, "Test Mail: 2 minutes after registration — Cron is working!")
            //     );
            // }

            // Mail::to($registration->email)->send(new WebinarLiveMail($registration, "Webinar is live now!"));

            if ($diffInMinutes == 61) {
                Mail::to($registration->email)->send(new WebinarReminderMail($registration, "Webinar starting in an hour"));
            } elseif ($diffInMinutes == 5) {
                Mail::to($registration->email)->send(new WebinarReminderMail($registration, "Webinar starting in 5 minutes "));
            } elseif ($diffInMinutes == 0) {
                Mail::to($registration->email)->send(new WebinarLiveMail($registration, "Webinar is live now!"));
            } elseif ($diffInMinutes == -61) {
                Mail::to($registration->email)->send(new WebinarReplayMail($registration, "Webinar ended 1 hour ago | Webinar Replay Available"));
            }
             elseif ($diffInMinutes == -(61*24*2)) { // 2 days after webinar ended
                Mail::to($registration->email)->send(new WebinarExpireMail($registration, "Webinar Replay Ending Soon"));
            }
            // elseif ($diffInMinutes == -1) {
            //     Mail::to($registration->email)->send(new WebinarReminderMail($registration, "Webinar ended 2 mins ago!"));
            // }
        }
    }

    public static function checkSlotTiming(WebinarRegistration $registration)
    {
        $now = Carbon::now('UTC');
        $slot = Carbon::parse($registration->slot); // already in UTC

        // Webinar is considered "live" for 15 minutes duration
        if ($now->between($slot, $slot->copy()->addMinutes(60))) {
            return 'live';
        } elseif ($now->lt($slot)) {
            return 'before'; // not started yet
        } else {
            return 'ended'; // already finished
        }
    }

}
