<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update1(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Người dùng chưa đăng nhập.'], 401);
        }
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
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Xác thực dữ liệu đầu vào
        $validatedData = $request->validate([
            'tieusu' => 'nullable|string|max:255',
            'linkurl' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|max:2048',
        ]);

        // Cập nhật thông tin tiểu sử và link URL
        $user->tieusu = $validatedData['tieusu'] ?? $user->tieusu;
        $user->linkurl = $validatedData['linkurl'] ?? $user->linkurl;

        // Kiểm tra và xử lý ảnh đại diện
        if ($request->hasFile('avatar')) {
            // Xóa ảnh đại diện cũ nếu có
            if ($user->avatar) {
                $oldAvatarPath = public_path('storage/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Xóa ảnh cũ
                }
            }

            // Lưu ảnh mới
            $fileName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $path = 'uploads/avatars/';
            $fullPath = public_path($path);

            // Kiểm tra xem thư mục đã tồn tại chưa, nếu không thì tạo mới
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Lưu ảnh và cập nhật đường dẫn trong cơ sở dữ liệu
            $request->file('avatar')->move($fullPath, $fileName);
            $user->avatar = $path . $fileName;
        }

        // Lưu thông tin người dùng đã cập nhật
        $user->save();

        return response()->json(['message' => 'Cập nhật thông tin cá nhân thành công!'], 200);
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
}
