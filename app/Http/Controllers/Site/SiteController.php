<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class SiteController extends Controller
{
    protected $totalpages = 10;
    public function index()
    {
        $posts_banner = DB::table('posts')
            ->where('featured', '=', 1)
            ->where('status', 'A')
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();
        //dd($posts_banner);

        $posts = DB::table('posts')
            ->where('featured', '=', 1)
            ->where('status', 'A')
            ->orderBy('created_at', 'desc')
            ->paginate($this->totalpages);
        return view ('site.index', compact('posts', 'posts_banner'));
    }

    public function categoria()
    {
        return view ('site.pages.categoria');
    }

    public function post()
    {
        return view ('site.pages.post');
    }

    public function empresa()
    {
        return view ('site.pages.empresa');
    }

    public function contato()
    {
        return view ('site.pages.contato');
    }
}
