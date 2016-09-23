<div class="row">
    <form id="form-category">
        {{ csrf_field() }}

        <div class="col-lg-12">
            <div class="box box-primary">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="input-category-name">Name</label>
                                <input type="text" required name="name" class="form-control" id="input-category-name" placeholder="Category Name" value="{{ $category->name }}">
                            </div>
                            <div class="form-group">
                                <label for="input-category-name">Name</label>
                                <textarea name="description" class="form-control">{{$category->description}}</textarea>
                            </div>
                        </div><!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>