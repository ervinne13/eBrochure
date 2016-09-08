@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/users/index.js") }}" type="text/javascript"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users        
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="users-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>                                        
                                        <th>Email</th>
                                        <th>Name</th>                                     
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div><!-- /.col -->                        
                    </div><!-- /.row -->
                </div><!-- ./box-body -->                
            </div><!-- /.box -->            
        </div>
    </div>

</section><!-- /.content -->

@endsection