@extends('admin.layouts.layout')


@section('main_content')
    <div class="container-fluid">

        <div class="row page-titles mb-4 py-3">

            <div class="d-flex align-items-center flex-wrap">
                <h3 class="me-auto my-0">Users Questions</h3>
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
                                        <th>Questoins</th>
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>

                                        <td>{{$item->id}}</td>
                                        <td>{{$item->registration->name}}</td>

                                    <td><a class="text-primary" href="mailto:{{$item->registration->email}}">{{$item->registration->email}}</a></td>
                                    <td>{{$item->registration->phone}}</td>


                                    <td>{{$item->question}}</td>



                                    <td>{{$item->created_at}}</td>

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

@endsection

