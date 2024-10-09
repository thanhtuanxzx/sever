<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\TuKhoa;
use App\Models\Citation;
use App\Models\TacGiaBaiViet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update1(Request $request)
    {
        
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Debug toàn bộ dữ liệu request trước khi validate

  
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',         
            'chucdanh' => 'nullable|string|max:255',
            'gioitinh' => 'nullable|string|max:10',         
           
        ]);
        
        
        $user->update($request->all());
       
        return redirect('/profile');
    }
    public function update2(Request $request)
    {
        
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Debug toàn bộ dữ liệu request trước khi validate

       
        $validatedData = $request->validate([
            'organization' => 'required|nullable|string|max:255',
        ]);
        
        
        $user->update($request->all());
       
        return redirect('/profile');
    }
    public function update3(Request $request)
    {
       
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();

        // Debug toàn bộ dữ liệu request trước khi validate
  
       
        $validatedData = $request->validate([
            'quyen' => 'required|boolean', 
            'linhvucnc' => 'required|string|max:255', 
      
        ]);
        
        
        
        $user->update($request->all());
       
        return redirect('/profile');
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
        $user->tieusu = $validatedData['tieusu'];
        $user->linkurl = $validatedData['linkurl'];

        // Kiểm tra và xử lý ảnh đại diện
        if ($request->hasFile('avatar')) {
            // Xóa ảnh đại diện cũ nếu có
            if ($user->avatar) {
                // Đường dẫn cũ của ảnh đại diện
                $oldAvatarPath = public_path('storage/' . $user->avatar);
                if (file_exists($oldAvatarPath)) {
                    unlink($oldAvatarPath); // Xóa ảnh cũ
                }
            }

            // Lấy tên tệp mới và đường dẫn lưu
            $fileName = time() . '_' . $request->file('avatar')->getClientOriginalName();
            $path = 'uploads/avatars/'; // Đường dẫn tương đối để lưu tệp
            $fullPath = public_path($path); // Đường dẫn tuyệt đối

            // Kiểm tra xem thư mục đã tồn tại chưa, nếu không thì tạo mới
            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0755, true);
            }

            // Lưu ảnh và cập nhật đường dẫn trong cơ sở dữ liệu
            $request->file('avatar')->move($fullPath, $fileName); // Di chuyển tệp
            $user->avatar = $path . $fileName; // Lưu đường dẫn tương đối vào cơ sở dữ liệu
        }

        // Lưu thông tin người dùng đã cập nhật
        $user->save();

        return redirect('/profile')->with('success', 'Thông tin cá nhân đã được cập nhật!');
    }

    
    public function update5(Request $request)
    {
        $validatedData = $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:6|confirmed', // Sử dụng 'confirmed' để xác nhận mật khẩu mới
        ]);
    
        // Lấy thông tin người dùng hiện tại
        $user = Auth::user();
    
        // Kiểm tra mật khẩu hiện tại
        if (!Hash::check($validatedData['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không chính xác.']);
        }
    
        // Cập nhật mật khẩu mới
        $user->password = Hash::make($validatedData['new_password']);
        $user->save();
    
        
       
        return redirect('/profile');
    }
}
