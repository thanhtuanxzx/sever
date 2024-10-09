<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Import model Article nếu bạn đã có model này
use App\Models\User;
use App\Models\TuKhoa;
use App\Models\Citation;
use App\Models\TacGiaBaiViet;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
class ArticleSubmissionController extends Controller
{
    // Hiển thị form nộp bài báo
    public function viewsb()
    {
       
    }

    
}
