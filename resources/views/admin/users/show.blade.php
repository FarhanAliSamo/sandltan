@extends('admin.layouts.layout')


@section('main_content')
    @php
        use Carbon\Carbon;
        $slotLocal = Carbon::parse($data->slot)->setTimezone($data->timezone);
        $slotLocalFormatted = $slotLocal->format('l, F j, Y \\a\\t g:i A (T)');
    @endphp

    <div class="container-fluid">

        <div class="row page-titles mb-4 py-3">

            <div class="d-flex align-items-center flex-wrap">
                <h3 class="me-auto my-0">User Detail </h3>
                <div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary me-3"><i
                            class="fa-solid fa-arrow-left me-2"></i> Back to Users List</a>
                    </a>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <div class="row g-2 gy-4">

                            <div class="col-lg-6">
                                <h2 class="text-primary user-detail-name">{{ $data->name }} </h2>
                                <p class="user-detail-id">#{{ $data->unique_id }}</p>
                                <h4 class="my-1 user-detail-list">{{ $data->phone }}</h4>
                                <h4 class="my-1 user-detail-list">{{ $data->email }}</h4>



                                <h4 class="my-1 user-detail-list">{{ $slotLocalFormatted }}</h4>

                            </div>

                            <div class="col-lg-6">

                                <h2 class="text-primary">Questions</h2>

                                <ul id="questionsList" class="list-group my-3">

                                    @foreach ($data->questions as $question )
                                    <li class="list-group-item">
                                        <strong>{{$question->question}}</strong>
                                        <br>
                                        <small class="text-secondary">Asked on: {{ \Carbon\Carbon::parse($question->created_at)->format('l, F j, Y \\a\\t g:i A') }}</small>
                                    </li>
                                    @endforeach

                                </ul>

                            </div>



                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Modal -->
    <div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">User Questions - <span id="modalUserName"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <ul id="questionsList" class="list-group">
                        <!-- JS will populate -->
                    </ul>
                </div>
            </div>
        </div>
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const modal = new bootstrap.Modal(document.getElementById('questionsModal'));
            const questionsList = document.getElementById('questionsList');
            const modalUserName = document.getElementById('modalUserName');

            document.querySelectorAll('.view-questions-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const questions = JSON.parse(button.getAttribute('data-questions'));
                    const username = button.getAttribute('data-username');

                    modalUserName.textContent = username;
                    questionsList.innerHTML = '';

                    if (questions.length === 0) {
                        questionsList.innerHTML =
                            '<li class="list-group-item text-muted">No questions found.</li>';
                    } else {
                        questions.forEach(q => {
                            const item = document.createElement('li');
                            item.classList.add('list-group-item');
                            item.innerHTML = `
                            <strong>${q.question}</strong>
                            <br>
                            <small class="text-secondary">Asked on: ${new Date(q.created_at).toLocaleString()}</small>
                        `;
                            questionsList.appendChild(item);
                        });
                    }
                });
            });
        });
    </script>
@endsection
