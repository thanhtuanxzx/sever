<?php

namespace App\Http\Controllers;

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
            'chucdanh' => 'nullable|string|max:255',
            'gioitinh' => 'nullable|string|max:10',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'Cập nhật thông tin cá nhân thành công!'], 200);
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

        return response()->json(['message' => 'Cập nhật tổ chức thành công!'], 200);
    }

    public function update3(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'quyen' => 'required|boolean',
            'linhvucnc' => 'required|string|max:255',
        ]);

        $user->update($validatedData);

        return response()->json(['message' => 'Cập nhật quyền và lĩnh vực nghiên cứu thành công!'], 200);
    }



    public function update4(Request $request)
    {
        
        $user = Auth::user();
    
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'file' => 'file|max:2048|mimes:jpeg,png,jpg,gif', // Kiểm tra loại file
        ]);
    
        // Xử lý file upload 

            $file = $request->file('file');
            $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
            // Cập nhật thông tin file vào người dùng
            $user->avatar_original_name = $file->getClientOriginalName();
            $user->avatar = $generatedFileName;
    
            // Lưu thông tin người dùng
            if ($user->save()) {
                return response()->json(['message' => 'File tải lên thành công và thông tin người dùng đã được cập nhật'], 200);
            } else {
                return response()->json(['message' => 'Có lỗi khi cập nhật thông tin người dùng'], 500);
            }
        
    
        // Trả về phản hồi khi không có file nào được tải lên
        return response()->json([
            'message' => 'Không có file nào được tải lên',
         
        ], 200);
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
            return response()->json(['message' => 'Mật khẩu hiện tại không chính xác.'], 403);
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();

        return response()->json(['message' => 'Cập nhật mật khẩu thành công!'], 200);
    }
    public function show(Request $request)
    {
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Kiểm tra xem người dùng có tồn tại không
        if (!$user) {
            return response()->json(['message' => 'Người dùng không tồn tại.'], 404);
        }

        // Trả về thông tin người dùng
        return response()->json($user, 200);
    }

}
