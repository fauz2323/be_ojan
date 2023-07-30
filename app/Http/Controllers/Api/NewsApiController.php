<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WisataNews;
use Illuminate\Http\Request;

class NewsApiController extends Controller
{
    public function getNews()
    {
        $news = WisataNews::all();
        return response()->json([
            'news' => $news,
        ]);
    }

    public function getNewsById($id)
    {
        $news = WisataNews::find($id);
        return response()->json([
            'news' => $news,
        ]);
    }
}
