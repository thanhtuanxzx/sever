<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\WizardProgress;
use App\Models\User;
use App\Models\TuKhoa;
use App\Models\Citation;
use App\Models\TacGiaBaiViet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class KtraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showSubmissions()
    {
           
        $wizardProgress = WizardProgress::where('user_id', Auth::id())->get();

   
        $baiVietIds = $wizardProgress->pluck('bai_viet_id')->unique();

        $baiVietList = BaiViet::whereIn('id_bai_viet', $baiVietIds)->get();
    

        return view('layout_index.Submissions',compact('wizardProgress'),compact('baiVietList'));
    }
    public function showwizardstep1()
    {
        // Truyền biến $user đến view nếu cần
        return view('wizard.step1');
    }

}

