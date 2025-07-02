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



            if ($registration->yesterday) {
                $now = Carbon::now('UTC');
                $createdAtUtc = Carbon::parse($registration->created_at)->setTimezone('UTC');
                $diffInMinutes = $now->diffInMinutes($createdAtUtc, false);

                // Log actual difference for debugging
                Log::info("User yesterday registered: {$registration->email}, Created : {$createdAtUtc}, Now: {$now}, Diff: {$diffInMinutes} mins");

            } else {

                $now = Carbon::now('UTC');
                $slot = Carbon::parse($registration->slot);
                $diffInMinutes = $now->diffInMinutes($slot, false);

                // Log actual difference for debugging
                Log::info("User: {$registration->email}, Slot: {$slot}, Now: {$now}, Diff: {$diffInMinutes} mins");
            }


            if ($registration->yesterday) {

                if ($diffInMinutes == -61) {
                    Mail::to($registration->email)->queue(new WebinarReplayMail($registration, "Webinar Attend 1 hour ago | Webinar Replay Available"));
                }elseif ($diffInMinutes == - (61 * 24 * 2)) { // 2 days after webinar ended
                    Mail::to($registration->email)->queue(new WebinarExpireMail($registration, "Webinar Replay Ending Soon"));
                }
            } else {

                if ($diffInMinutes == 61) {
                    Mail::to($registration->email)->queue(new WebinarReminderMail($registration, "Webinar starting in an hour"));
                } elseif ($diffInMinutes == 5) {
                    Mail::to($registration->email)->queue(new WebinarReminderMail($registration, "Webinar starting in 5 minutes "));
                } elseif ($diffInMinutes == 0) {
                    Mail::to($registration->email)->queue(new WebinarLiveMail($registration, "Webinar is live now!"));
                } elseif ($diffInMinutes == -61) {
                    Mail::to($registration->email)->queue(new WebinarReplayMail($registration, "Webinar ended 1 hour ago | Webinar Replay Available"));
                } elseif ($diffInMinutes == - (61 * 24 * 2)) { // 2 days after webinar ended
                    Mail::to($registration->email)->queue(new WebinarExpireMail($registration, "Webinar Replay Ending Soon"));
                }
            }
        }
    }

    public static function checkSlotTiming(WebinarRegistration $registration)
    {
        $now = Carbon::now('UTC');
        $slot = Carbon::parse($registration->slot); // already in UTC

        if ($registration->yesterday) {
            return 'ended';
        }
        // Webinar is considered "live" for 36 minutes and 12 seconds duration
        $liveEnd = $slot->copy()->addMinutes(36)->addSeconds(12);
        if ($now->between($slot, $liveEnd)) {
            return 'live';
        } elseif ($now->lt($slot)) {
            return 'before'; // not started yet
        } else {
            return 'ended'; // already finished
        }
    }

    public static function getAdminEmail()
    {
        return 'marc@catrusts.law';
    }
}
