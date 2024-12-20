<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use App\Models\WizardProgress;
class UserController extends Controller
{
    public function update1(Request $request)
    {
       
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:10',
        ]);

        $user->update($validatedData);

        return response()->json(['status' => 200,'message' => 'Cập nhật thông tin cá nhân thành công!'], 200);
    }

    public function update2(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'organization' => 'required|nullable|string|max:255',
        ]);

        $user->update($validatedData);

        return response()->json(['status' => 200,'message' => 'Cập nhật tổ chức thành công!'], 200);
    }

    public function update3(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            // 'quyen' => 'required|boolean',
            'research_field' => 'required|string|max:255',
        ]);

        $user->update($validatedData);

        return response()->json(['status' => 200,'message' => 'Cập nhật lĩnh vực nghiên cứu thành công!'], 200);
    }
    public function update4(Request $request)
    {
        
 
        // Khởi tạo biến để lưu thông báo lỗi
        $errors = [];

        // Kiểm tra và xác thực dữ liệu
        try {
            $request->validate([
                'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
                'bio' => 'string|max:1000', // Tiểu sử là trường bắt buộc
                'homepage_url' => 'nullable|url', // Kiểm tra URL hợp lệ
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Lưu các lỗi vào biến
            $errors = $e->validator->errors()->toArray();
        }

        // Lưu ảnh nếu có và không có lỗi
        if (empty($errors)) {
            if ($request->hasFile('profile_image')) {
                $file = $request->file('profile_image');
                $fileName = time() . '_' . $file->getClientOriginalName(); // Tạo tên file duy nhất
                $path = $file->storeAs('public/avatars', $fileName); // Lưu vào thư mục avatars
                $profileImageUrl = Storage::url($path); // Lấy URL của ảnh
            } else {
                $profileImageUrl = null;
            }

            // Lấy dữ liệu từ request
            $bio = $request->input('bio');
            $homepageUrl = $request->input('homepage_url');

            // Xử lý lưu trữ thông tin vào cơ sở dữ liệu
            $user = auth()->user();
            $user->bio = $bio;
            $user->homepage_url = $homepageUrl;
            if ($profileImageUrl) {
                $user->avatar = $profileImageUrl;
            }
            $user->save();
            // dd($bio, $homepageUrl, $profileImageUrl);


            // Trả về phản hồi thành công
            return response()->json([
                'status' => 200,
                'message' => 'Hồ sơ đã được cập nhật thành công',
                'data' => [
                    'bio' => $bio,
                    'homepage_url' => $homepageUrl,
                    'profile_image' => $profileImageUrl,
                ]
            ]);
        } else {
            // Nếu có lỗi, trả về lỗi
            return response()->json([
                'status' => 422,
                'message' => 'Có lỗi xảy ra',
                'errors' => $errors,
            ], 422); // Trả về mã trạng thái 422 Unprocessable Entity
        }
    }
    


    

    public function getAvatar(Request $request)
    {
        // Lấy người dùng đã xác thực
        $user = $request->user();
    
        // Lấy đường dẫn avatar
        $avatarPath = $user->avatar;
    
        // Trả về tên tệp của avatar
        return response()->json([
            'avatar' => basename($avatarPath), // Chỉ lấy tên tệp
        ]);
    }
    
    

    


    public function update5(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed',
        ]);

        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return response()->json(['status' => 403,'message' => 'Mật khẩu hiện tại không chính xác.'], 403);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['status' => 200,'message' => 'Cập nhật mật khẩu thành công!'], 200);
    }
    public function show(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return response()->json(['status' => 404,'message' => 'Người dùng không tồn tại.'], 404);
        }

        // Trả về thông tin người dùng
        return response()->json([
            'status' => 200,
            'data' => $user
        ], 200);
        
    }

}
