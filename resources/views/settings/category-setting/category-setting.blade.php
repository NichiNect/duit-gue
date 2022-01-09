<div class="container">
    <div class="row my-3">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=""><i class="fas fa-cog"></i> Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-cubes"></i> Category Setting</li>
                </ol>
            </nav>

            <h4>Category Setting</h4>

            <div class="d-flex justify-content-end">
                <a href="{{ route('settings.setting.getviewcontent') }}?view=new-category" id="new-category" class="btn btn-success"><i class="fas fa-plus"></i> Create New Category</a>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-striped table-border">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category Name</th>
                            <th>Description</th>
                            <th>Category Color</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->description }}</td>
                                <td>
                                    <div class="btn btn-{{ $category->color }} py-3 px-4"></div>
                                </td>
                                <td>
                                    @if ($category->is_active == 1)
                                        <div class="badge badge-outline-success">Active</div>
                                    @else
                                        <div class="badge badge-outline-danger">Not Active</div>
                                    @endif
                                </td>
                                <td>{{ $category->created_at->diffForHumans() . ', ' . $category->created_at }}</td>
                                <td>
                                    <a href="{{ route('transactions.index') }}?category={{ $category->id }}" class="btn btn-link py-1 px-1">Browse Transaction</a>
                                    <a href="#" data-urlupdate="{{ route('settings.category.updatecategory', $category->id) }}" data-urldata="{{ route('categories.show', $category->id) }}" id="btnUpdateCategory" class="btn btn-warning text-white py-1 px-1">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<x-modal name="updateCategoryModal" method="post" title="Edit Category" okButton="Submit" okButtonColorClass="success" closeButton="Close" closeButtonColorClass="secondary">
    @csrf
    @method('put')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Fill category name field..">
            </div>
            <div class="form-group">
                <label for="category_description">Category Description</label>
                <textarea name="category_description" id="category_description" cols="10" rows="5" class="form-control" placeholder="Fill category description field.."></textarea>
            </div>
        </div>
    </div>
    <div class="row justify-content-between">
        <div class="col-md-12">
            <label for="color">Category Color</label>
            <br>
            <input type="radio" name="color" id="color-success" value="success">
            <label for="color-success" class="btn btn-success py-3 px-4"></label>

            <input type="radio" name="color" id="color-primary" value="primary">
            <label for="color-primary" class="btn btn-primary py-3 px-4"></label>

            <input type="radio" name="color" id="color-danger" value="danger">
            <label for="color-danger" class="btn btn-danger py-3 px-4"></label>

            <input type="radio" name="color" id="color-info" value="info">
            <label for="color-info" class="btn btn-info py-3 px-4"></label>

            <input type="radio" name="color" id="color-warning" value="warning">
            <label for="color-warning" class="btn btn-warning py-3 px-4"></label>
            
            <input type="radio" name="color" id="color-secondary" value="secondary">
            <label for="color-secondary" class="btn btn-secondary py-3 px-4"></label>
        </div>
    </div>
</x-modal>

<script>
    async function getView (url) {

        let view = await axios.get(url, {
            headers: {
                "Content-Type": "text/html"
            }
        }).catch((err) => {
            console.log(err);
            cardContent.html('<h3>View Not Found</h3>');
        });

        console.log(view);

        if (view.status == 200) {
            cardContent.html(view.data);
        }
    }

    $('#new-category').on('click', async function (e) {
        e.preventDefault();

        let cardContent = $('#card-content');
        let href = $(this).attr('href');

        await getView(href);
    });

    $('table td #btnUpdateCategory').on('click', async function (e) {
        e.preventDefault();

        let url = $(this).data('urldata');

        let category = await axios.get(url);

        if (category.status == 200) {

            let urlUpdate = $(this).data('urlupdate');

            let form = $('#updateCategoryModal form').attr('action', urlUpdate);

            let radio = $('#updateCategoryModal input[type=radio]');

            console.log(form);

            $('#updateCategoryModal #category_name').val(category.data.data.name);
            $('#updateCategoryModal #category_description').val(category.data.data.description);
            
            console.log(category.data.data);

            for (let i=0; i<radio.length; i++) {

                if (category.data.data.color == radio[i]['value']) {
                    
                    $(`#updateCategoryModal input[value=${radio[i]['value']}]`).attr('checked', true);
                } 
            }

            $('#updateCategoryModal').modal('show');
        }

    });

</script>