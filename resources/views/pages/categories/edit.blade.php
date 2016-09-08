@extends('layouts.lte')

@include('templates.table-inline-actions')

@section('js')
<script src="{{ asset ("/js/form-utilities.js") }}" type="text/javascript"></script>
<script src="{{ asset ("/vendor/jquery/jquery.validate.js") }}" type="text/javascript"></script>

<script src="{{ asset ("/js/pages/categories/form.js") }}" type="text/javascript"></script>

<script type="text/javascript">
var categoryId = '{{$category->id}}';
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

    <div class="row">
        <div class="col-lg-12">
            <div class="box-foot pull-right">                
                <button id="action-update-close" type="button" class="btn btn-primary">Update And Close</button>
            </div>
        </div>
    </div>

</section><!-- /.content -->

@endsection