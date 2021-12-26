@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row my-3">
        <div class="col-md-12">
            <h2>Settings</h2>
            
            <div>
                <x-alert></x-alert>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-header">
                  <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                      <a class="nav-link" id="satu" href="{{ route('settings.setting.getviewcontent') }}?view=user-profile">User Profile</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="dua" href="{{ route('settings.setting.getviewcontent') }}?view=change-password">Change Password</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="tiga" href="{{ route('settings.setting.getviewcontent') }}?view=category-setting">Category Setting</a>
                    </li>
                  </ul>
                </div>
                <div class="card-body" id="card-content">
                    <h5 class="card-title my-4">Welcome to Settings, Please be sure if you confirm that you changes!</h5>
                </div>
              </div>
        </div>
    </div>

</div>

@endsection

@section('script')
<script>
    let cardContent = $('#card-content');

    async function getView (url) {

        let view = await axios.get(url, {
            headers: {
                "Content-Type": "text/html"
            }
        }).catch((err) => {
            cardContent.html('<h3>View Not Found</h3>');
        });

        if (view.status == 200) {
            cardContent.html(view.data);
        }

    }

    $('#satu').on('click', async function(e) {
        e.preventDefault();
        $('#satu').addClass('active');
        $('#dua').removeClass('active');
        $('#tiga').removeClass('active');

        let href = $(this).attr('href');
        await getView(href);
    });

    $('#dua').on('click', async function(e) {
        e.preventDefault();
        $('#satu').removeClass('active');
        $('#dua').addClass('active');
        $('#tiga').removeClass('active');
        
        let href = $(this).attr('href');
        await getView(href);
    });

    $('#tiga').on('click', async function(e) {
        e.preventDefault();
        $('#satu').removeClass('active');
        $('#dua').removeClass('active');
        $('#tiga').addClass('active');
        
        let href = $(this).attr('href');
        await getView(href);
    });

</script>
@endsection
