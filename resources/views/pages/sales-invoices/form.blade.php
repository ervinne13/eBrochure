<div class="row">
    <form id="form-sales-invoice">
        {{ csrf_field() }}
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Invoice Header</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">                            
                            <div class="form-group">
                                <label>Customer Name</label>
                                <input type="text" disabled class="form-control" value="{{ $si->customer_name }}">
                            </div>
                            <div class="form-group">
                                <label>Customer Email</label>
                                <input type="text" disabled class="form-control" value="{{ $si->customer_email }}">
                            </div>
                            <div class="form-group">
                                <label>Customer Contact</label>
                                <input type="text" disabled name="contact" class="form-control" value="{{ $si->customer_contact }}">
                            </div>
                            <div class="form-group">
                                <label for="input-address">Customer Address</label>
                                <textarea id="input-address" disabled class="form-control">{{$si->customer_address}}</textarea>
                            </div>
                        </div>

                        <!--Right Panel-->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="status">
                                    @foreach($statusList AS $status)
                                    <?php $selected = $status == $si->status ? "selected" : "" ?>
                                    <option value="{{$status}}" {{$selected}}>{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Total Item Qty</label>
                                <input type="text" disabled class="form-control" value="{{ $si->total_item_qty }}">
                            </div>
                            <div class="form-group">
                                <label>Total Amount</label>
                                <input type="text" disabled class="form-control" value="{{ $si->total_amount }}">
                            </div>
                            <div class="form-group">
                                <label>Discount</label>
                                <input type="text" name="discount" class="form-control" value="{{ $si->discount }}">
                            </div>
                            <div class="form-group">
                                <label>Remarks</label>
                                <textarea name="remarks" class="form-control">{{$si->remarks}}</textarea>
                            </div>                            
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </form>
</div>