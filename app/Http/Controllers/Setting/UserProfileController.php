<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
    /**
     * Update User Profile
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $r)
    {
        $r->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email'
        ]);

        $user = User::findOrFail(auth()->user()->id)
                ->update([
                    'name' => $r->name,
                    'email' => $r->email
                ]);
        
        return redirect()->route('settings.setting.index')->with('success', 'Edit Profile Updated Successfully');
    }

    /**
     * Change New Password with Old Password Confirmation
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $r)
    {
        $user = User::findOrFail(auth()->user()->id);

        $r->validate([
            'old_password' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $checkPassword = \Hash::check($r->old_password, $user->password);

        if ($checkPassword == true) {
            $user->update([
                'password' => bcrypt($r->password)
            ]);
        } else {
            return redirect()->route('settings.setting.index')->with('error', 'Failed to Update Password');
        }

        return redirect()->route('settings.setting.index')->with('success', 'New Password Updated Successfully');
    }
}
