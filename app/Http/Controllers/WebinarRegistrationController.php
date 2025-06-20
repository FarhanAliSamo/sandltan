<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WebinarRegistration;
use App\Mail\WebinarRegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\RegistrarAttendMail;
use App\Mail\RegistrationAdminMail;
use App\Helpers\WebinarReminderHelper;

class WebinarRegistrationController extends Controller
{

    // public function register(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email|max:255',
    //         'phone' => 'required|max:12',
    //         'slot' => 'required', // in any timezone format
    //     ]);

    //     // STEP 1: Detect the timezone from input automatically
    //     // Carbon can parse offsets like +05:00, -04:00 or Z (UTC) properly
    //    $slotOriginal = Carbon::parse($request->slot);

    //     // STEP 2: Convert it to UTC for storage and cron accuracy
    //     $slotUtc = $slotOriginal->copy()->setTimezone('UTC');

    //     // Optional: Store user's original timezone offset for frontend display (not required for logic)
    //     $timezoneOffset = $slotOriginal->getTimezone()->getName();

    //     \Log::info("User registered with original slot: " . $request->slot);
    //     \Log::info("Converted to UTC slot: " . $slotUtc->toDateTimeString());

    //     $existing = WebinarRegistration::where('slot', $slotUtc)
    //         ->where('email', $request->email)
    //         ->first();

    //     if ($existing) {
    //         return response()->json(['message' => 'You have already registered for this slot.'], 400);
    //     }

    //     // Save
    //     $registration = new WebinarRegistration();
    //     $registration->name = $request->name;
    //     $registration->email = $request->email;
    //     $registration->phone = $request->phone;
    //     $registration->slot = $slotUtc; // stored in UTC
    //     $registration->timezone = $timezoneOffset; // e.g. "Asia/Karachi" or "+05:00"
    //     $registration->unique_id = bin2hex(random_bytes(16));
    //     $registration->save();

    //      Mail::to($registration->email)->send(new WebinarRegistrationMail($registration, "Your Registration is successful"));
    //     return response()->json(['message' => 'Registration successful!'], 200);
    // }

    // public function register(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'name' => 'required|string|max:255',
    //             'email' => 'required|email|max:255',
    //             'phone' => 'required|max:12',
    //         ]);

    //         if ($request->slot == 'yesterdays_now') {
    //             // If 'yesterdays_now' is set, save current UTC time minus 1 minute
    //             $slotUtc = Carbon::now('UTC')->subMinute();
    //         } else {
    //             // Otherwise, parse the provided slot (assumed UTC)
    //             $localTime = Carbon::parse($request->slot, $request->timezone); // User input in local
    //             $slotUtc = $localTime->copy()->setTimezone('UTC');

    //             Log::info("Local time : " . $localTime);
    //             Log::info("Converted UTC time : " . $slotUtc);
    //             Log::info("Current UTC time: " . Carbon::now('UTC')->format('Y-m-d H:i:s e'));
    //         }

    //         if ($request->slot != 'yesterdays_now') {
    //             $existing = WebinarRegistration::where('slot', $slotUtc)
    //                 ->where('email', $request->email)
    //                 ->first();

    //             if ($existing) {
    //                 return response()->json(['message' => 'Registration successful!', 'link' =>  url('webinar-show/' . $existing->unique_id)], 200);
    //             }
    //         }

    //         $registration = new WebinarRegistration();
    //         $registration->name = $request->name;
    //         $registration->email = $request->email;
    //         $registration->phone = $request->phone;
    //         $registration->slot = $slotUtc; // Save in global time (UTC)
    //         $registration->timezone = $request->timezone;
    //         $registration->unique_id = bin2hex(random_bytes(16));

    //         if ($request->slot == 'yesterdays_now') {
    //             $registration->attend = 1;
    //             $registration->yesterday = 1;
    //             Mail::to(WebinarReminderHelper::getAdminEmail())->queue(new RegistrarAttendMail($registration, "Registrant ATTENDED Webinar!"));
    //         }

    //         $registration->save();
    //         Log::info("✅ Webinar saved: " . json_encode($registration->toArray()));
    //         Mail::to(WebinarReminderHelper::getAdminEmail())->queue(new RegistrationAdminMail($registration, "New Registration Alert!"));

    //         if ($request->slot == 'yesterdays_now') {
    //             return response()->json(['message' => 'Registration successful! you will redirect to yesterday webinar', 'link' =>  url('webinar-show/' . $registration->unique_id)], 200);
    //         } else {
    //             Mail::to($registration->email)->queue(new WebinarRegistrationMail($registration, "Registration Successful!"));
    //             return response()->json(['message' => 'Registration successful!', 'link' =>  url('webinar-show/' . $registration->unique_id)], 200);
    //         }
    //     } catch (\Exception $e) {
    //         Log::error('Webinar registration failed: ' . $e->getMessage());
    //         return response()->json(['message' => 'Registration failed. Please try again later.'], 500);
    //     }
    // }


    public function register(Request $request)
{
    try {
        // ✅ Step 1: Validate basic fields
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255',
            'phone'    => 'required|max:12',
            'timezone' => 'required|string',
        ]);

        // ✅ Step 2: Calculate slot UTC time
        $isYesterdaySlot = $request->slot === 'yesterdays_now';
        $slotUtc = $isYesterdaySlot
            ? Carbon::now('UTC')->subMinute()
            : Carbon::parse($request->slot, $request->timezone)->copy()->setTimezone('UTC');

        // Log slot conversion info (for debugging)
        Log::info("📅 Registration Slot UTC: " . $slotUtc);

        // ✅ Step 3: Check for existing registration if not yesterday
        if (!$isYesterdaySlot) {
            $existing = WebinarRegistration::where('slot', $slotUtc)
                ->where('email', $request->email)
                ->first();

            if ($existing) {
                return response()->json([
                    'message' => 'Registration successful!',
                    'link'    => url('webinar-show/' . $existing->unique_id),
                ], 200);
            }
        }

        // ✅ Step 4: Save new registration
        $registration = new WebinarRegistration();
        $registration->name      = $validated['name'];
        $registration->email     = $validated['email'];
        $registration->phone     = $validated['phone'];
        $registration->slot      = $slotUtc;
        $registration->timezone  = $validated['timezone'];
        $registration->unique_id = bin2hex(random_bytes(16));

        // Flags for 'yesterdays_now'
        if ($isYesterdaySlot) {
            $registration->attend    = 1;
            $registration->yesterday = 1;
        }

        $registration->save();
        Log::info("✅ Webinar registration saved:", $registration->toArray());

        // ✅ Step 5: Send Mails
        if ($isYesterdaySlot) {
            Mail::to(WebinarReminderHelper::getAdminEmail())
                ->queue(new RegistrarAttendMail($registration, "Registrant ATTENDED Webinar!"));
        } else {
            Mail::to($registration->email)
                ->queue(new WebinarRegistrationMail($registration, "Registration Successful!"));
        }

        // Always notify admin
        Mail::to(WebinarReminderHelper::getAdminEmail())
            ->queue(new RegistrationAdminMail($registration, "New Registration Alert!"));

        // ✅ Step 6: Final response
        return response()->json([
            'message' => $isYesterdaySlot
                ? 'Registration successful! Redirecting to yesterday’s webinar.'
                : 'Registration successful!',
            'link'    => url('webinar-show/' . $registration->unique_id),
        ], 200);

    } catch (\Throwable $e) {
        Log::error('❌ Webinar registration failed:', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Registration failed. Please try again later.',
        ], 500);
    }
}

}
