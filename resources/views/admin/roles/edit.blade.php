@extends('admin.layouts.app')
@section('title') Role @endsection

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
                                <h3 class="card-title">Edit Role</h3>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('roles.update', $role->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Role Title</label>
                                            <input type="hidden" class="form-control" name="role_id" id="role_id" value="{{ $role->id }}">
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title" value="{{ $role->name }}" placeholder="Add Role title">
                                            @error('title')
                                            <div class="badge badge-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Permission</label>
                                                <select class="form-control duallistbox @error('permission') is-invalid @enderror" multiple="multiple" name="permission[]">
                                                    @foreach($permission as $value)
                                                        @if(in_array($value->id, $rolePermissions))
                                                            <option value="{{ $value->name }}" selected>{{ $value->name }}</option>
                                                        @else
                                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                                @error('permission')
                                                <div class="badge badge-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group float-right">
                                        <button type="reset" class="btn btn-warning">Reset</button>
                                        <button type="submit" class="btn btn-success">Save</button>
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
@push('scripts')
    <script>
        //Bootstrap Duallistbox
        $('.duallistbox').bootstrapDualListbox()
    </script>
@endpush

