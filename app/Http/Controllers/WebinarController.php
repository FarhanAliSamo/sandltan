<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\WebinarRegistration;
use App\Models\WebinarQuestion;
use App\Mail\WebinarRegistrationMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Helpers\WebinarReminderHelper;
use App\Mail\RegistrarAttendMail;

class WebinarController extends Controller
{

  public function show($uid)
    {

        $data = WebinarRegistration::where('unique_id', $uid)->first();
        if (!$data) {
            abort(404, 'Registration not found.');
        }

        $slotStatus = WebinarReminderHelper::checkSlotTiming($data);

        // dd($data,$slotStatus);


        if ($slotStatus === 'before') {
            return view('frontend.webinar.timer', compact('data')); // show countdown/timer page
        }

        if ($slotStatus === 'ended') {
             return view('frontend.webinar.recorded', compact('data')); // show countdown/timer page
        }


        Mail::to(env('ADMIN_EMAIL'))->send(new RegistrarAttendMail($data, "Registrar Attend Email Alert!"));

        $data->attend = 1 ;
        $data->save();

        // continue to actual webinar view
        return view('frontend.webinar.live', compact('data'));
    }

    
    public function QuestionStore(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:500',
            'uid' => 'required',
        ]);

        $registration = WebinarRegistration::where('unique_id', $request->uid)->first();

        if (!$registration) {
            return response()->json(['error' => false, 'message' => 'Registration not found.'], 404);
        }

        $question = new WebinarQuestion();
        $question->question = $request->question;
        $question->uid = $request->uid;
        $question->webinar_registration_id = $registration->id;
        $question->save();

        return response()->json(['success' => true, 'message' => 'Question submitted successfully.']);


        // try {
        //     $webinar = WebinarRegistration::findOrFail($request->webinar_id);
        //     $webinar->questions()->create([
        //         'question' => $request->question,
        //         'user_id' => auth()->id(), // Assuming user is authenticated
        //     ]);

        //     Mail::to($webinar->email)->send(new WebinarRegistrationMail($webinar));

        //     return redirect()->back()->with('success', 'Question submitted successfully.');
        // } catch (\Exception $e) {
        //     Log::error('Error submitting question: ' . $e->getMessage());
        //     return redirect()->back()->with('error', 'Failed to submit question. Please try again later.');
        // }
    }

}
