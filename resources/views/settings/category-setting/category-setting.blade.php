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
                                    <a href="" id="edit-category" class="btn btn-warning text-white py-1 px-1">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

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
    })
</script>