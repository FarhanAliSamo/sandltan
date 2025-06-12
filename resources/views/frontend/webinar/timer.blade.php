@extends('frontend.layouts.master_layout')
@section('title', 'Timer')

@section('content')

    @php
        // Laravel se slot UTC me bhej rahe ho
        $slotUtc = \Carbon\Carbon::parse($data->slot)->toIso8601String(); // e.g., 2025-06-04T12:26:00Z
        $eventTitle = 'Live Webinar'; // title for the event
    @endphp


    <div class="container  d-flex flex-column justify-content-center align-items-center text-center timer_header">
        <h1 class="timer_title">How to Protect Your Family After You Are Gone - The 3 Things You Need to Know with Marc Joyce
        </h1>
    </div>


    <div class="timer_body">
        <div class="container ">
            <div class="row">
                <div class="col-md-6 ">
                    <div class="timer_clock d-flex justify-content-end align-items-center">
                        <img src="{{ asset('assets/images/clock.png') }}" alt="">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="timer_content d-flex flex-column justify-content-center align-items-center">
                        <p>Scheduled for: <span class="fw-bold" id="local-time"></span></p>
                        <p>Your event will begin in:</p>
                        <span class="remainig_timer" id="countdown">Loading...</span>

                        <a id="add-to-calendar-link" style="text-decoration: none" href="#" target="_blank">
                            <button type="button" class="add_to_calendar_btn">
                                <i class="fa-solid fa-calendar-circle-plus"></i> Add to Calendar
                            </button>
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>



        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const slotUtc = "{{ $slotUtc }}";
                const eventTime = new Date(slotUtc); // UTC Time
                const localTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;

                // Format local time display
                const localEventTime = eventTime.toLocaleTimeString([], {
                    timeZone: localTimeZone,
                    hour: '2-digit',
                    minute: '2-digit',
                    hour12: true
                });

                document.getElementById("local-time").innerText = `${localEventTime} (${localTimeZone})`;

                // Countdown logic
                let countdownInterval;
                function updateCountdown() {
                    const now = new Date();
                    const diff = eventTime - now;

                    if (diff <= 0) {
                        document.getElementById("countdown").innerText = "📢 It's live now!";
                        clearInterval(countdownInterval); // Stop the interval
                        location.reload(); // Reload the page to update the content
                        return;
                    }

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    document.getElementById("countdown").innerText =
                        `${hours} hours, ${minutes} minutes, ${seconds} seconds`;
                }

                updateCountdown();
                countdownInterval = setInterval(updateCountdown, 1000);

                // Add to Google Calendar Link
                const title = encodeURIComponent("{{ $eventTitle }}");
                const startTime = new Date(slotUtc).toISOString().replace(/-|:|\.\d\d\d/g, ""); // Google format
                const endTime = new Date(new Date(slotUtc).getTime() + 60 * 60 * 1000).toISOString().replace(
                    /-|:|\.\d\d\d/g, ""); // +1 hour

                const calendarLink =
                    `https://www.google.com/calendar/render?action=TEMPLATE&text=${title}&dates=${startTime}/${endTime}&details=Join+our+live+webinar!&ctz=${localTimeZone}`;

                document.getElementById("add-to-calendar-link").setAttribute("href", calendarLink);

            });
        </script>


@endsection
