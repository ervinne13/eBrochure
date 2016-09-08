@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('css')
<link href="{{ asset("/vendor/dataTables/datatables.min.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/datatable-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/products/index.js") }}" type="text/javascript"></script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Products        
    </h1>
</section>

<section class="content">

    <div class="row">
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="products-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            <a href="/products/create">
                                                <i class="fa fa-plus"></i>
                                            </a>
                                        </th>                                        
                                        <th>Model</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Remaining Stock</th>
                                        <th>Price</th>                                        
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