<div class="row">
    <form id="form-sales-invoice">
        {{ csrf_field() }}
        <div class="col-lg-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Invoice Details</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-12">                            
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Sub Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($si->details AS $detail)
                                    <tr>
                                        <td>{{$detail->product->category->name}}</td>
                                        <td>{{$detail->product->name}}</td>
                                        <td>{{$detail->qty}}</td>
                                        <td>{{$detail->sub_total}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </form>
</div>