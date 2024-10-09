<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminPageController extends Controller
{
    public function adminArtDone()
    {
        return view('Admin_page.Admin-art-done');
    }

    public function adminArtRejected()
    {
        return view('Admin_page.Admin-art-rejected');
    }

    public function adminArticleDetails()
    {
        return view('Admin_page.Admin-article-details');
    }

    public function adminMagazine()
    {
        return view('Admin_page.Admin-magazine');
    }

    public function adminDashboard()
    {
        return view('Admin_page.Admin');
    }

    public function magazineDetails()
    {
        return view('Admin_page.magazine-details');
    }

    public function magazineList()
    {
        return view('Admin_page.magazine-list');
    }
}
