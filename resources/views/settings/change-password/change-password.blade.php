<div class="container">
    <div class="row my-3">
        <div class="col-lg-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href=""><i class="fas fa-cog"></i> Settings</a></li>
                  <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-key"></i> Change Password</li>
                </ol>
            </nav>
    
            <h4>Change Password</h4>
            <small class="text-muted font-italic">Last updated data at: {{ $user->updated_at->diffForHumans() . ', ' . $user->updated_at }}</small>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-lg-12">
            <form action="{{ route('settings.userprofile.changepassword') }}" method="post">
                @csrf
                @method('patch')
                <div class="form-group row">
                    <label for="old_password" class="col-sm-2 col-form-label">Old Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="old_password" class="form-control" id="old_password" placeholder="Fill old password field..">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Fill new password field..">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="confirm_password" class="col-sm-2 col-form-label">Repeat New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Fill new repeat password field..">
                    </div>
                </div>
                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary"><i class="fas fa-check"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>