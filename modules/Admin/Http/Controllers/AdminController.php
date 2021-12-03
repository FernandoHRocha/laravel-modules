<?php

namespace Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return response()->json( DB::table('users')
                        ->join('posts','users.id','=','posts.user_id')
                        ->select('users.id','users.name','users.email',DB::raw('count(posts.user_id) as post_count'))
                        ->groupBy('users.id','users.name','users.email')
                        ->get()
            , 200);
    }

    public function store(Request $request) {

    }

    public function show($id) {

    }

    public function update(Request $request, $id) {

    }

    public function destroy($id) {
        
    }
}