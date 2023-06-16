@extends('layouts.admin')

@section('title')
    <title>Categories</title>
@endsection

@section('styles')
    <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
@endsection


@section('content')


<div class="row mb-4">
    <div class="col-md-6">
        <h2>Knowledge Base</h2>
    </div>
    <div class="col-md-6 float-right">
        <a href="" class="btn btn-md btn-success mr-2 float-sm-right mt-3 mb-2"> Add Knowledge <i class="fa fa-plus-square"></i></a>
    </div>
</div>  


@if ($message = Session::get('success'))
<div class="alert alert-success alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
</div>
@endif

                            <div class="row">
                                <div class="col-12">
                                    <div class="card m-b-30">
                                        <div class="card-body">

                                            <table id="datatable" class="table table-bordered">
                                                <thead>
                                                <tr>
                                                    <th>Category</th>
                                                    <th>Content</th>													
                                                    <th>Title</th>
                                                    <th>Alias</th> 
                                                    <th>Public</th> 													
                                                    <th>Status</th>  				
                                                    <th>Options</th> 													
                                                </tr>
                                                </thead>
                                                <tbody>
                        @foreach($knowledgebases as $knowledgebase)
                                                <tr>
                                                    <td>{{ $knowledgebase->category->name }}</td>
                                                    <td>{{ $knowledgebase->content }}</td>
                                                    <td>{{ $knowledgebase->title }}</td>				
                                                    <td>{{ $knowledgebase->alias }}</td>	
                                                    <td>{{ $knowledgebase->public==1 ? 'Public':'Private' }}</td>			
                                                    <td>{{ $knowledgebase->status==1 ? 'Active':'Inactive' }}</td>													
                          <td>
                          <a href="#" class="btn btn-icon" title="Edit Knowledge"><i class="fa fa-pencil-square-o edit_knowledge" knowledge_id="{{ $knowledgebase->id }}" data-toggle="modal" data-target="#editModal"></i></a>

                          </td>
                                                </tr>
                        @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div> <!-- end col -->
                            </div> <!-- end row -->


                            <!-- Modal -->
                            <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <form action="" method="post">
                                @csrf
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Category</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                   <label>Title:</label>  
                                   <div class="col-sm-12"> <input type="text" name="title" class="form-control" id="title"></div>					   
                                  </div>
                                  <input type="hidden" name="lang_id" id="lang_id">
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-primary" value="Update">
                                  </div>
                                </div>
                              </div>
                            </form>
                            </div>
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
<script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
<!-- Responsive examples -->
<script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
<!-- Datatable init js -->
<script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
