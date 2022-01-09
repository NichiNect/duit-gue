<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public static $ACTIVE_STATUS = '1';
    public static $INACTIVE_STATUS = '0';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('creator')->get();

        if (request()->expectsJson()) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Request successfully.',
                'data' => $categories
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::with('creator')->findOrFail($id);

        if (request()->expectsJson()) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Request successfully',
                'data' => $category
            ]);
        }
    }
}
