@extends('layouts.admin')

@section('title')
    <title>Users</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')


<div class="row mb-4">
    <div class="col-md-6">
        <h2>Users</h2>
    </div>
    <div class="col-md-6 float-right">
        @if (Auth::user()->id==1)
        <a href="#" class="mass-delete btn btn-md btn-danger float-sm-right mt-3 mb-2">Delete <i class="fa fa-trash"></i></a>
        @endif
        <a href="{{route('admin.blog.create')}}" class="btn btn-md btn-success mr-2 float-sm-right mt-3 mb-2"> Create User <i class="fa fa-plus-square"></i></a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table id="datatable" class="table table-bordered">
                    <thead>
                    <tr>
                      <th><input type="checkbox" class="filled-in primary-color" id="select-all" /><label for="select-all"></label></th>
                      <th>User</th>
                      <th>Role</th>
                      <th>Status</th>
                      <th class="icon-options">Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td><input type="checkbox" class="filled-in primary-color case" id="{{$user->id}}" /><label for="{{$user->id}}"></label></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{$user->activated ? 'Active' : 'Inactive'}}</td>
                        <td>
                            <a href="" class="btn btn-icon" title="Masquerade as User"><i class="fa fa-user-secret brown-font"></i></a>
                            <a href="{{route('admin.user.edit', $user->id)}}" class="btn btn-icon" title="Edit User"><i class="fa fa-pencil-square-o"></i></a>
                            <a href="javascript:void(0);" class="activate-button btn btn-icon {{$user->status ? 'hidden': ''}}" data-id="{{$user->id}}" title="Activate User"><i class="fa fa-check-square"></i></a>
                            <a href="javascript:void(0);" class="deactivate-button btn btn-icon {{$user->status ? '': 'hidden'}}" data-id="{{$user->id}}" title="Deactivate User"><i class="fa fa-window-close-o"></i></a>
                            <a href="javascript:void(0);" class="deactivate-button btn btn-icon {{$user->status ? '': 'hidden'}}" data-id="{{$user->id}}" title="Deactivate User"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->


@endsection

@section('scripts')

<script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>

<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/sweet-alert2/sweetalert2.min.js') }}"></script>
<script>
$(document).ready(function() {
    $('#datatable').DataTable({
      paging: true,
      bFilter: false,
      ordering: false,
      searching: true,
    } );
} );
</script>

@endsection
