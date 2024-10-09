<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Citation;
class ArticleController extends Controller
{
    public function create()
    {
        $authors = Author::all(); // Giả sử bạn có model Author
        return view('article.create', compact('authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'chu_de' => 'required',
            'checklist.*' => 'required',
            'ghichu' => 'required',
            'tieu_de' => 'required',
            'tom_tat' => 'required',
            'tu_khoa' => 'required',
            'danh_sach_dong_tac_gia' => 'required',
        ]);

        // Xử lý lưu bài viết
        $article = new Article();
        $article->chu_de = $request->chu_de;
        $article->ghichu = $request->ghichu;
        $article->tieu_de = $request->tieu_de;
        $article->tom_tat = $request->tom_tat;
        $article->tu_khoa = $request->tu_khoa;
        $article->save();

        return redirect()->route('article.create')->with('success', 'Bài viết đã được lưu.');
    }
}
