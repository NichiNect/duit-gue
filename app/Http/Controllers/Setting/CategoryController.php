<?php

namespace App\Http\Controllers\Setting;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Create New Category
     *
     * @param  \Illuminate\Http\Request  $r
     * @return \Illuminate\Http\Response
     */
    public function insertCategory(Request $r)
    {
        $r->validate([
            'category_name' => 'required|string|max:60',
            'category_description' => 'required|string|max:255',
            'color' => 'required|string'
        ]);

        $category = Category::create([
            'name' => $r->category_name,
            'description' => $r->category_description,
            'color' => $r->color,
            'creator_id' => auth()->user()->id,
            'is_active' => 1
        ]);

        return redirect()->route('settings.setting.index')->with('success', 'New Category Created Successfully');
    }
}
