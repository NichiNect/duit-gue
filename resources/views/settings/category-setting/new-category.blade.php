<div class="container">
    <div class="row my-3">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=""><i class="fas fa-cog"></i> Settings</a></li>
                  <li class="breadcrumb-item"><a href=""><i class="fas fa-cubes"></i> Category Setting</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-plus"></i> Create New Category</li>
                </ol>
            </nav>

            <h4>Create New Category</h4>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-12">
            <form action="{{ route('settings.category.insertcategory') }}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Fill category name field..">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="category_description" class="col-sm-2 col-form-label">Category Description</label>
                    <div class="col-sm-10">
                        <textarea name="category_description" id="category_description" cols="10" rows="5" class="form-control" placeholder="Fill category description field.."></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="" class="col-sm-2 col-form-label">Category Color</label>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-success" class="form-check-input" value="success">
                        <label for="color-success" class="btn btn-success py-3 px-4"></label>
                    </div>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-primary" class="form-check-input" value="primary">
                        <label for="color-primary" class="btn btn-primary py-3 px-4"></label>
                    </div>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-danger" class="form-check-input" value="danger">
                        <label for="color-danger" class="btn btn-danger py-3 px-4"></label>
                    </div>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-info" class="form-check-input" value="info">
                        <label for="color-info" class="btn btn-info py-3 px-4"></label>
                    </div>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-warning" class="form-check-input" value="warning">
                        <label for="color-warning" class="btn btn-warning py-3 px-4"></label>
                    </div>
                    <div class="col-sm-1">
                        <input type="radio" name="color" id="color-secondary" class="form-check-input" value="secondary">
                        <label for="color-secondary" class="btn btn-secondary py-3 px-4"></label>
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
