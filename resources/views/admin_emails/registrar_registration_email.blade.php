<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Registration</title>
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
            background-color: #fff;
            padding: 30px 40px;
            border-bottom: 1px solid #e9ecef;
        }

        .header h1 {
            margin: 0;
            font-size: 20px;
            color: #343a40;
            font-weight: 600;
            text-align: center;

        }

        .content {
            padding: 40px;
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
            margin-bottom: 20px;
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

    @php
        use Carbon\Carbon;

        $name = $registration->name;
        $email = $registration->email;

        if(!$registration->yesterday){
            $slotUtc = Carbon::parse($registration->slot)->toIso8601String(); // stored in UTC
            $slotLocalDefault = Carbon::parse($registration->slot)
                ->setTimezone('America/Los_Angeles')
                ->format('l, F j @ g:i A T'); // fallback timezone with PDT/PST
        }
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

    <div class="body">
        <div class="email-container">
            <div class="header">
                <h1>New Registration Alert</h1>
            </div>

            <div class="content">
                <div class="schedule-info">

                    <p>Name : <strong>{{ $name }}</strong></p>

                    <p>
                        Email : <strong>{{ $email }}</strong>
                    </p>
                    <p>
                        Phone : <strong>{{ $registration->phone }}</strong>
                    </p>

                    <p>Slot : <strong>{{ $registration->yesterday ? 'yesterdays Now' : $slotLocalDefault }}</strong></p>

                    <p>Session Id : <strong>{{ $registration->unique_id }}</strong></p>

                    <br>
                    <p>{{ $name }} has register for the webinar</p>

                </div>
            </div>

            <div class="footer">
                © 2025 <a href="#">events.trustedestatepianners.com</a>
            </div>
        </div>
    </div>
</body>

</html>
