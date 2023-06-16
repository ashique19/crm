@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-md-6 col-xl-3">
          <a href="{{ route('admin.blog')}}"><div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <i class="fa fa-file-text font-32"></i>
                <h3 class="text-primary">Manage Blogs</h3>
            </div>
        </div></a>
    </div>
    <div class="col-md-6 col-xl-3">
          <a href="{{ route('admin.user')}}"><div class="card text-center m-b-30">
            <div class="mb-2 card-body text-muted">
                <i class="fa fa-users font-32"></i>
                <h3 class="text-primary">Users</h3>
            </div>
        </div></a>
    </div>
</div>

@endsection
