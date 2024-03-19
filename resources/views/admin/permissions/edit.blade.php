@extends('admin.layouts.app')
@section('title') Permission @endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Permissions</li>
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
                                <h3 class="card-title">Edit Permission</h3>
                                <a href="{{ route('permissions.index') }}" class="btn btn-success float-right"><i class="fa fa-list"> View Permissions</i> </a>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @elseif(session('error'))
                                <div class="alert alert-danger">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('permissions.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PATCH')
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="">Title</label>
                                            <input type="hidden" class="form-control" name="permission_id" id="permission_id" value="{{ $permission->id }}">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $permission->name }}" placeholder="Add Permission title">
                                            @error('title')
                                            <div class="badge badge-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                        <div class="form-group float-right">
                                            <button type="reset" class="btn btn-warning">Reset</button>
                                            <button type="submit" class="btn btn-success">Update</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

