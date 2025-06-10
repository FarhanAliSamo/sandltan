<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WebinarRegistration;
use App\Mail\WebinarRegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


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

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|max:12',
            'slot' => 'required', // Format: 2025-05-26T16:52:00+05:00 or with timezone
        ]);


        // 1. Parse the input (which is already in UTC)
        $slotUtc = Carbon::parse($request->slot); // "Z" in input means UTC

        // 2. If you need to display it in user's local time (As    ia/Karachi)
        //$userLocalTime = $slotUtc->copy()->setTimezone('Asia/Karachi');

        // Debugging logs
        Log::info("Input slot (UTC): " . $slotUtc->format('Y-m-d H:i:s e'));
        //Log::info("Converted to local time: " . $userLocalTime->format('Y-m-d H:i:s e'));
        Log::info("Current UTC time: " . Carbon::now('UTC')->format('Y-m-d H:i:s e'));


        // Optional: Store user's timezone name or offset for UI
        $timezoneOffset = $slotUtc->getTimezone()->getName();

        $existing = WebinarRegistration::where('slot', $slotUtc)
            ->where('email', $request->email)
            ->first();

        if ($existing) {
            return response()->json(['message' => 'You have already registered for this slot.'], 400);
        }

        $registration = new WebinarRegistration();
        $registration->name = $request->name;
        $registration->email = $request->email;
        $registration->phone = $request->phone;
        $registration->slot = $slotUtc; // Save in global time (UTC)
        $registration->timezone = $timezoneOffset;
        $registration->unique_id = bin2hex(random_bytes(16));
        $registration->save();

        Mail::to($registration->email)->send(new WebinarRegistrationMail($registration, "Registration Successful!"));

        return response()->json(['message' => 'Registration successful!'], 200);
    }
 
}
 