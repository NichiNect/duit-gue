<div class="container">
    <div class="row my-3">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}"><i class="fas fa-cog"></i> Settings</a></li>
                  <li class="breadcrumb-item"><a href="{{ route('settings.setting.index') }}"><i class="fas fa-user"></i> User Profile</a></li>
                  <li class="breadcrumb-item" aria-current="page"><i class="fas fa-user-edit"></i> Edit Profile</li>
                </ol>
            </nav>

            <h4>Edit My Profile - {{ $user->name }}</h4>
            <small class="text-muted font-italic">Please be sure that you edit your profile correctly.</small>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-12">
            <form action="{{ route('settings.userprofile.updateprofile') }}" method="post">
                @csrf
                @method('put')
                <div class="form-group row">
                    <label for="username" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" name="username" class="form-control" id="username" readonly value="{{ $user->username }}" placeholder="Fill username field..">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Account Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" placeholder="Fill name field..">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">E-mail</label>
                    <div class="col-sm-10">
                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" placeholder="Fill email field..">
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure want to update your profile?')"><i class="fas fa-check"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>