@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/dataTables/datatables.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/vendor/jquery/jquery.validate.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/products/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var productId = 0;
</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create
        <small>Product</small>
    </h1>
</section>

<section class="content">

    @include('pages.products.form')

    @include('module.parts.create-mode-actions')

</section><!-- /.content -->

@endsection