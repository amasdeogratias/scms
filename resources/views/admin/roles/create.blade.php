@extends('admin.layouts.app')
@section('title') Role @endsection

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
                                <h3 class="card-title">Create Role</h3>
                            </div>
                            @if (session('message'))
                                <div class="alert alert-success">
                                    {{ session('message') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="">Role Title</label>
                                            <input class="form-control @error('title') is-invalid @enderror" name="title" id="title" placeholder="Add Role title">
                                            @error('title')
                                            <div class="badge badge-danger mt-2">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
{{--                                    <div class="row">--}}
{{--                                        <div class="form-check col-md-12">--}}
{{--                                            <label for="">Permissions</label>--}}
{{--                                            <br/>--}}
{{--                                            @foreach($permission as $value)--}}
{{--                                                <input class="form-check-input @error('permission') is-invalid @enderror" type="checkbox" name="permission[]" id="permission_{{ $value->id }}" value="{{ $value->id }}" {{ old('permission') && in_array($value->id, old('permission')) ? 'checked' : '' }}>--}}
{{--                                                <label class="form-check-label" for="permission_{{ $value->id }}">--}}
{{--                                                    {{ $value->name }}--}}
{{--                                                </label>--}}
{{--                                                <br/>--}}
{{--                                            @endforeach--}}
{{--                                            @error('title')--}}
{{--                                            <div class="badge badge-danger mt-2">{{ $message }}</div>--}}
{{--                                            @enderror--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Permission</label>
                                                    <select class="form-control duallistbox @error('permission') is-invalid @enderror" multiple="multiple" name="permission[]" id="permission">
                                                        @foreach($permission as $value)
                                                            <option value="{{ $value->name }}">{{ $value->name }}</option>
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

