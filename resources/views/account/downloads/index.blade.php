@extends('layouts.app')

@section('title')
<title>Downloads</title>
@endsection

@section('styles')
<style>
    .nav{
        display: inherit;
    }
    .cat_tabs li a.active{
        color: #fff !important;
        background-image: linear-gradient(-20deg, #fc6076 0%, #ff9a44 100%) !important;
        background-color: #ff9a44 !important;
    }
</style>
@endsection

@section('breadcrumb')
<!-- Page-Title -->
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="crumbs float-right">
                <ul id="breadcrumbs" class="breadcrumb">
                    <li><a href="{{ route('account.dashboard') }}"><i class="fa fa-tachometer"></i></a></li>
                    <li class="active"><a href="javascript:void(0);">Downloads</a></li>
                </ul>
            </div> 
            <h4 class="page-title"> <i class="fa fa-tachometer"></i>Downloads</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->
@endsection

@section('content')

<div class="row">
    <div class="col-3 mb-sm-0"> 
        <div class="card">  
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="list-unstyled nav cat_tabs" role="tablist">
                    @foreach($categories AS $key=>$category)
                    <li class="">
                        <a class="nav-link btn btn-rounded mb-2 mt-3 btn-gradient-default {{ $key==0?'active show':'' }}" data-toggle="tab" href="#{{ Str::slug($category->name,'-') }}{{ $category->id }}" role="tab" aria-selected="false">{{ $category->name }}</a>
                                                    
                    </li>
                    @endforeach            
                </ul>
            </div>
        </div>
    </div>

    <div class="col-9 mb-sm-0"> 
        <div class="card">  
            <div class="card-body">
                <!-- Tab panes -->
                <div class="tab-content">
                    @foreach($categories AS $key=>$category)
                        <div class="tab-pane p-3 {{ $key==0?'active show':'' }}" id="{{ Str::slug($category->name,'-') }}{{ $category->id }}" role="tabpanel">
                            <div id="datatable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="datatable{{$key}}" class="table table-bordered dataTable no-footer datatable" role="grid" aria-describedby="datatable_info">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting_asc" tabindex="0" aria-controls="datatable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending">File Name</th>
													<th>Size</th>
													<th>Download</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($downloads AS $download)
                                                    @if($download->category_id == $category->id)
                                                        <tr role="row">
                                                            <td class="sorting_1">
                                                                <a href="{{ route('account.download.download',Crypt::encryptString($download->file)) }}" target="_blank">{{ $download->name }}</a>
                                                            </td>
                                                            <td class="sorting_1">
															{{ round((filesize(storage_path('app/public/downloads/'.$download->file)) / 100000), 1) }} MB
                                                            </td>
                                                            <td class="sorting_1">
                                                                <a class="btn btn-primary" href="{{ route('account.download.download',Crypt::encryptString($download->file)) }}" target="_blank">Download</a>
                                                            </td>															
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>                        
                        </div>    
                    @endforeach     
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
<!-- Responsive datatable examples -->
<link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<!-- Required datatable js -->
<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Buttons examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>

<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.datatable').DataTable();
    } );
</script>
@endsection