@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('js')
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/pages/categories/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var categoryId = 0;
</script>

@endsection

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Create
        <small>Category</small>
    </h1>
</section>

<section class="content">

    @include('pages.categories.form')

    @include('module.parts.create-mode-actions')

</section><!-- /.content -->

@endsection