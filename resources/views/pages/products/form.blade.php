<div class="row">
    <form id="form-product">
        {{ csrf_field() }}
        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Product Info</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label for="input-store-name">Category</label>                        
                            <select class="form-control" name="category_id">
                                @foreach($categories AS $category) 
                                <?php $selected = $category->id == $product->category_id ? "selected" : "" ?>
                                <option value="{{$category->id}}" {{$selected}}>{{$category->name}}</option>
                                @endforeach
                            </select>
                            <div class="form-group">
                                <label for="input-email">Name</label>
                                <input type="text" required name="name" class="form-control" id="input-name" value="{{ $product->name }}">
                            </div>
                            <div class="form-group">
                                <label for="input-model">Model</label>
                                <input type="text" required name="model" class="form-control" id="input-model" value="{{ $product->model }}">
                            </div>
                            <div class="form-group">
                                <label for="input-stock">Stock Count</label>
                                <input type="number" required name="stock" class="form-control" id="input-stock" value="{{ $product->stock }}">
                            </div>
                            <div class="form-group">
                                <label for="input-price">Unit Price</label>
                                <input type="number" required name="price" class="form-control" id="input-price" value="{{ $product->price }}">
                            </div>
                        </div>

                        <!--Right Panel-->

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="input-description">Description</label>
                                <textarea id="input-description" class="form-control" name="description">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="input-product-image">Product Image</label>
                                <input type="file" id="input-product-image" name="image">
                                <p class="help-block">Ideal size is 250px x 250px</p>

                                <img src="{{ URL::to('/') . $product->image->url }}" width="250px" height="250px" id="product-image">
                                <input type="hidden" name="url">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
    </form>
</div>