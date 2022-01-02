<?php

namespace App\Http\Controllers\Setting;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    /**
     * Display a settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(auth()->user()->id);
        $categories = $user->categories()->get();

        return view('settings.index', compact('user', 'categories'));
    }

    public function getViewContent ()
    {
        $params = request('view');
        $user = User::findOrFail(auth()->user()->id);
        $categories = $user->categories()->get();

        if ($params == 'user-profile') {
            return view('settings.user-profile.user-profile', compact('user'));
        } else if ($params == 'change-password') {
            return view('settings.change-password.change-password', compact('user'));
        } else if ($params == 'category-setting') {
            return view('settings.category-setting.category-setting', compact('categories'));
        }
        // Child Content
          else if ($params == 'edit-user-profile') {
                return view('settings.user-profile.edit-user-profile', compact('user'));
          }

        return response()->json([
            'status' => 404,
            'statusCode' => 404,
            'message' => 'Parameters of request not found.',
            'data' => null
        ], 404);
    }

}
