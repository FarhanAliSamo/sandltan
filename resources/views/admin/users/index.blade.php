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
                                        <th>Create Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                    <tr>

                                        <td>{{$item->id}}</td>
                                        <td>{{$item->name}}</td>
                                    <td><a class="text-primary" href="mailto:{{$item->email}}">{{$item->email}}</a></td>
                                    <td>{{$item->phone}}</td>

                                    @if($item->yesterday)
                                    <td>Yesterdays</td>
                                    @else
                                    <td>{{$item->slot}}</td>
                                    @endif

                                    <td>
                                        @if($item->attend)
                                        <span class="badge light badge-primary">Attended <i class="fa-solid fa-check ms-1"></i></span>
                                        @else
                                        <span class="badge light badge-danger">Not Yet <i class="fa-solid fa-xmark ms-1"></i></span>
                                        @endif

                                    </td>
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

