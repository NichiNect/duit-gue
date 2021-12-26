<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserProfileController extends Controller
{
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
}
