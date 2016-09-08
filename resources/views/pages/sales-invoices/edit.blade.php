@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('js')
<script src="{{ asset ("/vendor/underscore/underscore.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/vendor/jquery/jquery.validate.min.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/js/pages/sales-invoices/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var siId = '{{$si->id}}';
</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Sales Invoice
        <small>SI-{{str_pad($si->id, 8, '0', STR_PAD_LEFT)}}</small>
    </h1>
</section>

<section class="content"> 

    @include('pages.sales-invoices.form')

    @include('pages.sales-invoices.details')

    @include('module.parts.edit-mode-actions')

</section><!-- /.content -->

@endsection