@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/vendor/jquery/jquery.validate.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/products/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var productId = '{{$product->id}}';
</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Edit
        <small>{{ $product->name }}</small>
    </h1>
</section>

<section class="content">

    @include('pages.products.form')

    @include('module.parts.edit-mode-actions')

</section><!-- /.content -->

@endsection