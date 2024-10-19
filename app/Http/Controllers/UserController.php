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
        $userId = Auth::id();
        $user = User::find($userId);
        
        // Log thông tin user để kiểm tra
        Log::info('User ID: ' . $userId);
        Log::info('User info: ', $user->toArray());

        // Validate file tải lên
        $request->validate([
            'file' => 'nullable|file|max:2048',
        ]);


        // Log thông tin file nếu có
        if ($request->hasFile('file')) {
            Log::info('File is uploaded');
            
            $file = $request->file('file');
        
            // Define the file name and path to store
            $filename = time() . '_' . $file->getClientOriginalName();
            Log::info('File name: ' . $filename);
            
            $filePath = $file->storeAs('uploads', $filename, 'public');
            Log::info('File path: ' . $filePath);

            // Cập nhật thông tin user
            $user->update(['file_path' => $filePath, 'file_name' => $filename]);

            // Log xác nhận đã cập nhật
            Log::info('User updated with file path and name');

            return response()->json([
                'message' => 'File tải lên thành công và bài viết đã được cập nhật',
                'file_path' => $filePath
            ], 200);
        }

        Log::warning('Không có file nào được tải lên');
        return response()->json(['message' => 'Không có file nào được tải lên'], 200);
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
