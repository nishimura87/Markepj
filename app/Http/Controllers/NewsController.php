<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use InterventionImage;

class NewsController extends Controller
{
    public function news(Request $request)
    {
        $user = Auth::user();
        $news = News::latest()->get();

        if(is_null($user)||($user->role=='member')){
            return view('news',compact('news'));
        }

        if($user->role=='admin'){
            return view('admin.news', compact('news'));
        }
        
    }

    public function showNews($id)
    {
        $news = News::find($id);

        return view('detailNews', compact('news'));
    }

    public function createNews(Request $request)
    {
        return view('admin.addNews');
    }

    public function confirmNews(NewsRequest $request)
    {
        $inputs = $request->all();
        $file = $request->file('img_path');

        if (isset($file)) {
        $path = $file->store('news_img','public');
        $image = $path;

        return view('admin.confirmNews' ,compact(
            'inputs','image'));
        }
        

        return view('admin.confirmNews' ,compact(
        'inputs'));
    }

    public function storeNews(Request $request)
    {
        $action = $request->get('action');

        if($action == 'back'){
        return redirect('/admin/news/store')->withInput();
        }

        if($action == 'submit'){
        $form['user_id'] =  Auth::id();

            if(isset($request->img_path)){
                $image = $request->img_path;
            }
            else{
                $image = null;
            }

        News::create([
            'user_id' => $form['user_id'],
            'title' => $request->title,
            'body' => $request->body,
            'img_path' => $image,
            ]);

        return redirect()->route('news');
        }
    }

    public function editNews($id)
    {
        $news = News::find($id);

        return view('admin.editNews', compact('news'));
    }

    public function fixNews($id)
    {
        $news = News::find($id);

        return view('admin.fixNews',compact('news'));
    }

    public function updateNews(NewsRequest $request, $id)
    {
        $news = News::find($id);
        $file = $request->file('img_path');

        if (isset($file)) {
            Storage::disk('public')->delete($file);
        }

        if(isset($request->img_path)){
            $path = $file->store('news_img','public');
        }
        else{
            $path = null;
        }

        $user['user_id'] =  Auth::id();

        $form = $news->fill([
            'user_id' => $user['user_id'],
            'title' => $request->title,
            'body' => $request->body,
            'img_path' => $path,
        ])->save();

        return redirect()->route('news');
    }

    public function deleteNews($id)
    {
        $news = News::destroy($id);

        return redirect()->route('news');
    }
}
