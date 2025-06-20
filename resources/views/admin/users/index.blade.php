@extends('admin.layouts.layout')


@section('main_content')

    <div class="container-fluid">

        <div class="row page-titles mb-4 py-3">

            <div class="d-flex align-items-center flex-wrap">
                <h3 class="me-auto my-0">Users</h3>
                {{-- <div>
                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".create-modal-lg"
                        class="btn btn-primary me-3"><i class="fas fa-plus me-2"></i>Add
                        User
                    </a>
                </div> --}}
            </div>
        </div>

        <div class="row">

            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example3" class="display" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Slot</th>
                                        <th>Attend</th>
                                        <th>Questions</th>
                                        <th>Create Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>

                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td><a class="text-primary"
                                                    href="mailto:{{ $item->email }}">{{ $item->email }}</a></td>
                                            <td>{{ $item->phone }}</td>

                                            @if ($item->yesterday)
                                                <td>Yesterdays</td>
                                            @else
                                                <td>{{ $item->slot }}</td>
                                            @endif

                                            <td>
                                                @if ($item->attend)
                                                    <span class="badge light badge-primary">Attended <i
                                                            class="fa-solid fa-check ms-1"></i></span>
                                                @else
                                                    <span class="badge light badge-danger">Not Yet <i
                                                            class="fa-solid fa-xmark ms-1"></i></span>
                                                @endif

                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-primary  view-questions-btn"
                                                    data-bs-toggle="modal" data-bs-target="#questionsModal"
                                                    data-questions='@json($item->questions)'
                                                    data-username="{{ $item->name }}">
                                                    {{ $item->questions->count() }}
                                                </button>
                                            </td>

                                            {{-- <td class="text-center">{{ $item->questions->count() }}</td> --}}
                                            <td>{{ $item->created_at }}</td>
                                            <td>
                                                <a href="{{route('admin.users.show',$item->unique_id)}}" class="btn btn-primary"><i class="fa-regular fa-eye"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Questions Modal -->
    <div class="modal fade" id="questionsModal" tabindex="-1" aria-labelledby="questionsModalLabel"
        aria-hidden="true">
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
    document.addEventListener('DOMContentLoaded', function () {
        const questionsList = document.getElementById('questionsList');
        const modalUserName = document.getElementById('modalUserName');
        const modal = new bootstrap.Modal(document.getElementById('questionsModal'));

        // Use event delegation for dynamically generated rows
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('view-questions-btn')) {
                const button = e.target;
                const questions = JSON.parse(button.getAttribute('data-questions'));
                const username = button.getAttribute('data-username');

                modalUserName.textContent = username;
                questionsList.innerHTML = '';

                if (questions.length === 0) {
                    questionsList.innerHTML = '<li class="list-group-item text-muted">No questions found.</li>';
                } else {
                    questions.forEach(q => {
                        const item = document.createElement('li');
                        item.classList.add('list-group-item');
                        item.innerHTML = `
                            <strong>${q.question}</strong><br>
                            <small class="text-secondary">Asked on: ${new Date(q.created_at).toLocaleString()}</small>
                        `;
                        questionsList.appendChild(item);
                    });
                }

                modal.show();
            }
        });
    });
</script>

@endsection
