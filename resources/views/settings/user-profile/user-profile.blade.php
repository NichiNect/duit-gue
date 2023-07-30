<div class="container">
    <div class="row my-3">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=""><i class="fas fa-cog"></i> Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-user"></i> User Profile</li>
                </ol>
            </nav>

            <h4>My Profiles - {{ $user->name }}</h4>
            <small class="text-muted font-italic">Last updated data at: {{ $user->updated_at->diffForHumans() . ', ' . $user->updated_at }}</small>
        </div>
    </div>
    <div class="row my-3 justify-content-center">
        <div class="col-lg-8">
            <div class="table-responsive">
                <table class="table table-striped table-border">
                    <tbody>
                        <tr>
                            <td>Username</td>
                            <td>:</td>
                            <td>{{ $user->username }}</td>
                        </tr>
                        <tr>
                            <td>Account Name</td>
                            <td>:</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td>E-mail</td>
                            <td>:</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                        <tr>
                            <td>Currency</td>
                            <td>:</td>
                            <td>IDR (Rp.)</td>
                        </tr>
                        <tr>
                            <td>User Created</td>
                            <td>:</td>
                            <td>{{ $user->created_at->diffForHumans() . ', ' . $user->created_at }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-left">
                                <a href="{{ route('settings.setting.getviewcontent') }}?view=edit-user-profile" id="edit-profile" class="btn btn-success"><i class="fas fa-user-edit"></i> Edit Profile</a>
                            </td>
                            <td></td>
                            <td class="text-right">
                                <a href="{{ route('logout') }}" class="btn btn-danger" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i> Logout</a>
                            </td>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </tr>
                    </tfoot>
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

    $('#edit-profile').on('click', async function (e) {
        e.preventDefault();

        let cardContent = $('#card-content');
        let href = $(this).attr('href');

        await getView(href);
    })
</script>