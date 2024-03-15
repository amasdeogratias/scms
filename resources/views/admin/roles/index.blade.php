@extends('admin.layouts.app')
@section('title') Roles @endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Roles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
            </div>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Role List</h3>
                                <a href="{{route('roles.create')}}" class="btn btn-success float-right"><i class="fa fa-plus-circle">Add Role</i></a>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped" id="example2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i=1;
                                        @endphp
                                        @foreach($roles as $role)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $role->name }}</td>
                                            <td>
                                                @foreach($role->permissions as $permission)
                                                    <label class="badge badge-info">{{ $permission->name }},</label>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ route('roles.show',$role->id) }}" class="btn btn-primary btn-sm">Show</a>
                                                <a href="{{ route('roles.edit',$role->id) }}" class="btn btn-success btn-sm">Edit</a>
                                                <a href="{{ route('roles.destroy',$role->id) }}" class="btn btn-danger btn-sm">Delete</a>
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
        </section>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endpush


