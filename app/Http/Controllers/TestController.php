<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller; // Thêm dòng nàyus
use Mail;
class TestController extends Controller
{
    public function testMail(){
        $user = User::create(["name"=> "","email"=> ""]);
    }
}
