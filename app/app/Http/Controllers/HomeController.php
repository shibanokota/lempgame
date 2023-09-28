<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Like;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
        public function index(Request $request) {

            $user_id = Auth::id();
            $from = $request->input('from');
            $until = $request->input('until');
            $part_search = $request->input('part_search');
            $menu_search = $request->input('menu_search');
            $q = Post::query();
             //日付が選択されたら
            if (!empty($request['from']) && !empty($request['until'])) {
                //ハッシュタグの選択された20xx/xx/xx ~ 20xx/xx/xxのレポート情報を取得
                $posts = Post::getDate($request['from'], $request['until']);
            } else {
            // 全件取得(検索かけなかったら全件表示)
            $posts = $q->orderBy('created_at', 'desc')->get();
    
            // 日付検索
            
                
            }
    
           
    
    
        
     
        $user=auth()->user();
        return view('home', compact('posts', 'user', 'from', 'until'));
    }
    public function mypost() {
        $user=auth()->user()->id;
        $posts=Post::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('mypost', compact('posts'));
    }
    public function mycomment() {
        $user=auth()->user()->id;
        $comments=Comment::where('user_id', $user)->orderBy('created_at', 'desc')->get();
        return view('mycomment', compact('comments'));
    }
}
