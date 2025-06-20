@extends('frontend.layouts.master_layout')
@section('title', 'Live')

@section('content')

    @php
        use Carbon\Carbon;

        // $slotTimeUTC = Carbon::parse($data->slot)->timezone('UTC');

    @endphp

    <div class="shadow-sm">
        <p class="fw-bold py-3 container recorded_header_title my-0">

            <i class="fa-solid fa-play me-2" style="color: #1A9DD0"></i>
            How to Protect Your Family After You Are Gone - The 3 Things You Need to Know with Marc Joyce
            <span class="text-secondary fw-light">|</span>
            <span class="fw-normal">
                {{ Carbon::parse($data->slot)->format('M d, Y') }}
                {{-- May 27, 2025 --}}
            </span>
        </p>
    </div>

    <div class="container">
        <div class="row m-0">
            <div class="col-lg-8 border-end border-bottom ps-0 p-4 pb-5">

                <div id="videoPlaceHolder" class="placeholder-wave video_placeholder">

                </div>

                <div id="videoContainer" class="video_container">
                    <div class="live-indicator">
                        <div class="live-dot"></div>
                        LIVE
                    </div>

                    <div id="videOverLay" class="video_overlay" onclick="playHandle()">
                        <div class="btn_play">
                            <i class="fa-solid fa-play"></i>
                        </div>
                        <span class="video_overlay_title">Live Webinar</span>
                        <span class="video_overlay_text">Click to join live Webinar</span>
                    </div>



                    {{-- <video id="video" src="{{ asset('assets/videos/webinar.mp4') }}" class="video" controls
                        controlsList="nodownload noremoteplayback noplaybackrate" disablePictureInPicture
                        oncontextmenu="return false;"> --}}

                    <video id="video" src="{{ asset('assets/videos/webinar.mp4') }}" class="video"
                        oncontextmenu="return false;" disablePictureInPicture
                        controlsList=" nodownload noremoteplayback noplaybackrate">
                    </video>



                </div>

                <form onsubmit="QuestionSubmit(event)" class="qa_box_container mt-3">
                    <label class="qa_label">Please use this box to ask your questions. Responses will be sent to <span
                            class="qa_label_span">
                            {{ $data->email }}
                        </span> .
                    </label>

                    <span class="qa_error d-none"><i class="fa-solid fa-circle-exclamation  fs-6 me-1"></i> There was an
                        error please try again</span>
                    <textarea name="question" required placeholder="Type your question here..." class="form-control "></textarea>
                    <input type="text" name="uid" value="{{ $data->unique_id }}" hidden>
                    <button type="submit" id="submitBtn" class="fw-semibold question_submit_btn mt-2">Submit</button>
                    {{-- <input type="submit" id="submitBtn" value="Submit" class="fw-semibold question_submit_btn mt-3"> --}}

                </form>

                <div class="question_success_message mt-3 d-none">
                    <i class="fa-solid fa-check fs-6 me-1"></i> Thank you for submitting your question . <button
                        onclick="QuestionSwitch()">Click here to ask another.</button>
                </div>


            </div>
            <div class="col-lg-4 border-bottom ">

            </div>
        </div>
    </div>



    <footer class="footer">
        <p class="text-secondary">
            <a href="#">privacy policy</a> | <a href="#">terms of service</a> | Copyright 2025
            events.trustedestateplanners.com all rights reserved.
        </p>
    </footer>


@endsection

@section('scripts')



    <script>
        const video = document.getElementById('video');

        function playHandle() {
            const slotTimeUTC = "{{ \Carbon\Carbon::parse($data->slot)->format('Y-m-d\TH:i:s\Z') }}";
            const slot = new Date(slotTimeUTC); // UTC slot time
            const now = new Date(); // JS ka current time (local)

            // UTC mein convert karo (already UTC, but for safety)
            const nowUtc = new Date(now.toISOString());

            // Difference in seconds
            let diffInSeconds = Math.floor((nowUtc - slot) / 1000);
            if (diffInSeconds < 0) diffInSeconds = 0;

            const maxDuration = 2170; // 36 min - 10 sec minutes in seconds
            if (diffInSeconds >= maxDuration) {
                diffInSeconds = maxDuration;
            }

            const video = document.getElementById('video');
            video.currentTime = diffInSeconds;
            video.play();

            // UI handling
            $('#videOverLay').addClass('d-none');
            $('#videoPlaceHolder').addClass('d-none');
            $('#videoContainer').removeClass('d-none');
        }



        $(document).ready(function() {
            $('#videoPlaceHolder').addClass('d-none');
            $('#videoContainer').removeClass('d-none');
        });

        let QuestionSwitch = () => {
            $('.qa_box_container, .question_success_message').toggleClass('d-none');
        }
        let QuestionSubmit = (event) => {
            event.preventDefault();

            const $btn = $('#submitBtn');
            $btn.prop('disabled', true);
            $btn.html(
                '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Submitting...'
            );

            const question = $('textarea[name="question"]').val();
            const uid = $('input[name="uid"]').val();

            $.ajax({
                url: '{{ route('webinar.question.submit') }}', // Update this route as needed
                method: 'POST',
                data: {
                    question,
                    uid,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $btn.prop('disabled', false);
                    $btn.html('Submit');
                    $('.qa_box_container').addClass('d-none');
                    $('.question_success_message').removeClass('d-none');
                    $('textarea[name="question"]').val('');
                    $('.qa_error').hide();
                },
                error: function(xhr) {
                    $btn.prop('disabled', false);
                    $btn.html('Submit');
                    let errorMsg = 'There was an error please try again';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg = xhr.responseJSON.message;
                    }
                    $('.qa_error').html('<i class="fa-solid fa-circle-exclamation  fs-6 me-1"></i> ' +
                        errorMsg).show();
                    setTimeout(() => {
                        $('.qa_error').hide();
                    }, 4000);
                }
            });
        }
    </script>

@endsection
