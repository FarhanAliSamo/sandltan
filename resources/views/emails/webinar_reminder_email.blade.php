{{-- <!DOCTYPE html>
<html>

<head>
    <title>Webinar Reminder</title>
</head>

<body>
    <h2>Hello {{ $registration['name'] }},</h2>
    <p>Thank you for registering for our webinar.</p>
    <p><strong>Email:</strong> {{ $registration['email'] }}</p>

    <p> <a href="{{ route('webinar.show', ['uid' => $registration->unique_id]) }}"><strong>Click here to join
                Webinar</strong></a> </p>

    <p>See you soon!</p>
</body>

</html> --}}

{{-- yeh purana code he is me srf varaible he he jo tum use kar sket ho  --}}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Webinar Confirmation</title>
    <style>
        .body {
            width: 100%;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 20px 0px;
        }

        .email-container {
            max-width: 650px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background-color: #f8f9fa;
            padding: 30px 40px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #343a40;
            font-weight: 600;
        }

        .content {
            padding: 40px;
            text-align: center;
        }

        .webinar-title {
            font-size: 18px;
            color: #495057;
            margin-bottom: 20px;
            line-height: 1.4;
            font-weight: 500;
        }

        .schedule-info {
            font-size: 16px;
            color: #6c757d;
            margin-bottom: 30px;
        }

        .webinar-btn {
            display: inline-block;
            background-color: #343a40;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 25px;
            font-weight: 500;
            font-size: 14px;
            margin-bottom: 30px;
            transition: background-color 0.3s ease;
        }

        .webinar-btn:hover {
            background-color: #495057;
        }

        .calendar-links {
            margin-bottom: 30px;
        }

        .calendar-link {
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            margin: 0 10px;
        }

        .calendar-link:hover {
            text-decoration: underline;
        }

        .disclaimer {
            font-size: 14px;
            color: #868e96;
            line-height: 1.5;
            margin-bottom: 10px;
        }

        .footer {
            background-color: #fff;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            font-size: 12px;
            color: #6c757d;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }

            .header,
            .content,
            .footer {
                padding: 20px;
            }

            .webinar-title {
                font-size: 16px;
            }
        }
    </style>
</head>

<body>
    <div class="body">
        @php
            use Carbon\Carbon;

            $name = $registration->name;
            $email = $registration->email;

            $timezone = $registration->timezone;

            // Webinar time in user's local timezone
            $slotLocal = Carbon::parse($registration->slot)->setTimezone($timezone);
            $slotLocalFormatted = $slotLocal->format('l, F j, Y \\a\\t g:i A (T)');

            // Calendar start & end time in local timezone (not UTC)
            $startTime = $slotLocal->format('Ymd\THis'); // e.g. 20250620T140000
            $endTime = $slotLocal->copy()->addHour()->format('Ymd\THis');

            $startTimeIso = $slotLocal->toIso8601String(); // for Outlook
            $endTimeIso = $slotLocal->copy()->addHour()->toIso8601String();

            $title = urlencode('Live Webinar: How to Protect Your Family After You Are Gone');
            $details = urlencode('Join our live webinar session.');
            $webinarLink = route('webinar.show', ['uid' => $registration->unique_id]);

            // ✅ Google Calendar URL (with local time and timezone name)
            $googleCalendarUrl =
                'https://www.google.com/calendar/render?action=TEMPLATE' .
                "&text={$title}" .
                "&dates={$startTime}/{$endTime}" .
                "&details={$details}" .
                "&location={$webinarLink}" .
                '&ctz=' .
                urlencode($timezone); // e.g. Asia/Karachi

            // ✅ Outlook Calendar URL (with ISO 8601 local time)
            $outlookCalendarUrl =
                'https://outlook.live.com/owa/?path=/calendar/action/compose&rru=addevent' .
                "&startdt={$startTimeIso}" .
                "&enddt={$endTimeIso}" .
                "&subject={$title}" .
                "&body={$details}" .
                "&location={$webinarLink}";

                // $slotUtc = Carbon::parse($registration->slot)->toIso8601String(); // stored in UTC
                // $slotLocal = Carbon::parse($registration->slot)->setTimezone('America/Los_Angeles'); // Change based on audience region if needed
                // $startTime = Carbon::parse($registration->slot)->format('Ymd\THis\Z'); // for calendar
                // $endTime = Carbon::parse($registration->slot)->addHour()->format('Ymd\THis\Z');

                // $title = urlencode('Live Webinar: How to Protect Your Family After You Are Gone');
                // $details = urlencode('Join our live webinar session.');
                // $webinarLink = route('webinar.show', ['uid' => $registration->unique_id]);

            // $googleCalendarUrl = "https://www.google.com/calendar/render?action=TEMPLATE&text={$title}&dates={$startTime}/{$endTime}&details={$details}&location={$webinarLink}";
            // $outlookCalendarUrl =
            //     "https://outlook.live.com/owa/?path=/calendar/action/compose&rru=addevent&startdt={$slotUtc}&enddt=" .
            //     Carbon::parse($registration->slot)->addHour()->toIso8601String() .
            //     "&subject={$title}&body={$details}&location={$webinarLink}";

        @endphp

        <div class="email-container" style="box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div class="header" style="background-color:#ffff">
                <h1>Webinar Reminder </h1>
            </div>

            <div class="content">
                <div class="webinar-title">
                    <strong>How to Protect Your Family After You Are Gone - The 3 Things You Need to Know with Marc
                        Joyce</strong>
                </div>

                <div class="schedule-info">
                    Scheduled for: <strong>{{ $slotLocalFormatted }}</strong>
                </div>

                <a style="color: #fff;" href="{{ $webinarLink }}" class="webinar-btn" target="_blank">Attend Now</a>



                <div class="disclaimer">
                    You have received this email communication because you signed up for a webinar.
                </div>
            </div>

            <div class="footer">
                <a href="#">Unsubscribe from webinar emails</a> |
                <a href="#">Unsubscribe from all emails</a>
                <br><br>
                © {{ now()->year }} <a href="#">events.trustedestateplanners.com</a>
            </div>
        </div>
    </div>
</body>

</html>
