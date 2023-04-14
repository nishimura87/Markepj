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
            $image = $file->store('news_img','public');
            dd($image);

            //s3利用の場合
            //$image = Storage::disk('s3')->putFile('/news_img', $file, 'public');

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
            if(isset($request->img_path)){
                //Storage::disk('public')->delete($request->img_path);

                //s3利用の場合
                $path = Storage::disk('s3')->delete($request->img_path);
            }
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

        $img_path = $news->img_path;
        if(isset($img_path)){
            //$path = Storage::disk('public')->delete($img_path);

            //s3利用の場合
            $path = Storage::disk('s3')->delete($img_path);
        }

        $file = $request->file('img_path');

        if(isset($request->img_path)){
            //$path = $file->store('news_img','public');

            //s3利用の場合
            $path = Storage::disk('s3')->putFile('/news_img', $file, 'public');
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
        $news_path = News::find($id);
        $img_path = $news_path->img_path;

        $news = News::destroy($id);
        //Storage::disk('public')->delete($img_path);

        //s3利用の場合
        $path = Storage::disk('s3')->delete($img_path);

        return redirect()->route('news');
    }
}
