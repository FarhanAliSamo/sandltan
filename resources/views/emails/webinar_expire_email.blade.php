{{-- yeh purana code he is me srf varaible he he jo tum use kar sket ho  --}}
{{-- <!DOCTYPE html>
<html>
<head>
    <title>Webinar Registration</title>
</head>

<body>
    <h2>Hello {{ $registration['name'] }},</h2>
    <p>Thank you for registering for our webinar.</p>
    <p><strong>Email:</strong> {{ $registration['email'] }}</p>
    <p> <a href="{{ route('webinar.show', ['uid' => $registration->unique_id]) }}"><strong>Click here to join
                Webinar</strong></a> </p>
    <p>See you soon!</p>
</body>

</html>
 --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Webinar expire</title>
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
            background-color: #3da150;
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

        .img {
            width: 100px;
            height: 100px;
            margin-bottom: 20px;
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
            use Illuminate\Support\Facades\Log;

            $name = $registration->name;
            $email = $registration->email;
            $timezone = $registration->timezone;

            // Webinar time in user's local timezone
            $slotLocal = Carbon::parse($registration->slot)->setTimezone($timezone);
            $slotLocalFormatted = $slotLocal->format('l, F j, Y \\a\\t g:i A (T)');

            $title = urlencode('Live Webinar: How to Protect Your Family After You Are Gone');
            $details = urlencode('Join our live webinar session.');
            $webinarLink = route('webinar.show', ['uid' => $registration->unique_id]);

            // $path = public_path('assets/images/play.png');
            // if (file_exists($path)) {
            //     $type = pathinfo($path, PATHINFO_EXTENSION);
            //     $data = file_get_contents($path);
            //     $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            // } else {
            //     $base64 = '';
            // }

            // Log::info('base 64 image: ' . $base64);

        @endphp

        <div class="email-container" style="box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
            <div class="header" style="background-color:#ffff">
                <h1>Webinar Replay Expiring Soon</h1>
            </div>

            <div class="content">


                <a href="{{ $webinarLink }}">
                    <img class="img" src="https://vissabuzz.nexztech.com/assets/images/time.png" alt="">
                </a>

                <div class="webinar-title">

                    <strong>How to Protect Your Family After You Are Gone - The 3 Things You Need to Know with Marc
                        Joyce</strong>
                </div>




                <div class="schedule-info">
                    Scheduled for: <strong>{{$slotLocalFormatted }}</strong>
                </div>

                <a style="color: #fff;" href="{{ $webinarLink }}" class="webinar-btn" target="_blank">View Replay
                    Now</a>


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
