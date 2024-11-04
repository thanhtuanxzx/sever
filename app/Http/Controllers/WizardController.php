<?php

namespace App\Http\Controllers;

use App\Models\User; // Thêm dòng này nếu User ở thư mục Models
use App\Models\BaiViet;
use App\Models\TuKhoa;
use App\Models\Citation;
use App\Models\TacGiaBaiViet;
use App\Models\WizardProgress;
use App\Models\File;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\Storage;

class WizardController extends Controller
   
{
    public function getAuthorIdByBaiVietId($idBaiViet)
    {
        // Lấy tất cả bản ghi từ bảng tac_gia_bai_viet có id_bai_viet tương ứng
        $tacGiaBaiViets = TacGiaBaiViet::where('id_bai_viet', $idBaiViet)->with('user')->get();
        
        // Kiểm tra nếu có tác giả
        if ($tacGiaBaiViets->isEmpty()) {
            return response()->json(['status' => 404,'error' => 'Không có tác giả nào cho bài viết này'], 404);
        }
    
        // Tạo mảng chứa kết quả với thông tin chi tiết của từng tác giả
        $result = [];
        foreach ($tacGiaBaiViets as $coAuthor) {
            if ($coAuthor->user) {  // Kiểm tra mối quan hệ user có tồn tại
                $result[] = [
                    'first_name' => $coAuthor->user->first_name,
                    'last_name' => $coAuthor->user->last_name,
                    'email' => $coAuthor->user->email,
                    'vai_tro' => $coAuthor->vai_tro,  // Lấy vai trò từ bản ghi tac_gia_bai_viet
                ];
            }
        }
    
        return response()->json([
           'status' => 200,
            'data' => $result
        ], 200);
    }
    




    public function getUserByEmail(Request $request)
    {
        
        // Xác thực email
        $request->validate([
            'email' => 'required|email',
        ]);

        // Tìm người dùng theo email
        $user = User::where('email', $request->email)->first();

        // Nếu tìm thấy, trả về thông tin
        if ($user) {
            return response()->json([
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
            ]);
        } else {
            return response()->json(['status' => 404,'error' => 'User not found.'], 404);
        }
    }
    public function show()
    {  
        $userId = Auth::id(); // Lấy ID người dùng đã xác thực
    
        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    
        // Lấy danh sách bài viết với current_step < 5 của người dùng hiện tại
        $baiViet = BaiViet::where('user_id', $userId) // Lọc theo user_id
            ->whereHas('wizardProgress', function ($query) {
                $query->where('current_step', '<', 5); // Chỉ lấy current_step < 5
            })->get();
    
        // Trả về dữ liệu dưới dạng JSON
        return response()->json($baiViet);
    }
    
    public function show1()
    {
        $userId = Auth::id(); // Lấy ID người dùng đã xác thực
    
        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    
        // Lấy danh sách bài viết với current_step = 4 của người dùng hiện tại
        $baiViet = BaiViet::where('user_id', $userId) // Lọc theo user_id
            ->whereHas('wizardProgress', function ($query) {
                $query->where('current_step', '=', 4); 
            })->get();
    
        // Trả về dữ liệu dưới dạng JSON
        return response()->json($baiViet);
    }
    
    public function storeStep1(Request $request ,$id_bai_viet=null)
    {
        $request->validate([
            'chu_de' => 'required|string|max:255',
            'ghichu' => 'required|string',
        ]);
        
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json(['status' => 401,'error' => 'User not authenticated','id'=>$id_bai_viet], 401);
        }
    
        if ($id_bai_viet) {
            // Nếu id_bai_viet được truyền, tìm bài viết để cập nhật
            $baiViet = BaiViet::find($id_bai_viet);
            
            if ($baiViet && $baiViet->user_id === $userId) { // Kiểm tra quyền sở hữu bài viết
                $baiViet->update([
                    'chu_de' => $request->input('chu_de'),
                    'ghichu' => $request->input('ghichu'),
                ]);
                
                // Cập nhật tiến trình
                $progress = WizardProgress::where('user_id', $userId)
                    ->where('bai_viet_id', $baiViet->id_bai_viet)
                    ->first();
                    
                if ($progress) {
                    $progress->update(['current_step' => 1]);
                } else {
                    WizardProgress::create([
                        'user_id' => $userId,
                        'bai_viet_id' => $baiViet->id_bai_viet,
                        'current_step' => 1
                    ]);
                }
    
                return response()->json([
                    'status' => 200,
                    'message' => 'Bài viết đã được cập nhật thành công',
                    'bai_viet_id' => $baiViet->id_bai_viet
                ], 200);
            } else {
                return response()->json(['error' => 'Bài viết không tồn tại hoặc bạn không có quyền sửa bài viết này'], 403);
            }
        }
    
        // Nếu id_bai_viet không được truyền, tạo mới bài viết
        $baiViet = BaiViet::create([
            'chu_de' => $request->input('chu_de'),
            'ghichu' => $request->input('ghichu'),
            'user_id' => $userId
        ]);
    
        // Tạo tiến trình mới
        WizardProgress::create([
            'user_id' => $userId,
            'bai_viet_id' => $baiViet->id_bai_viet,
            'current_step' => 1
        ]);
    
        return response()->json([
            'message' => 'Bước 1 đã lưu thành công',
            'bai_viet_id' => $baiViet->id_bai_viet
        ], 201);
    }
    

    // public function storeStep2(Request $request, $id_bai_viet = null)
    // {
    //     $userId = Auth::id();

    //     if (!$userId) {
    //         return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
    //     }

    //     // Lấy tiến trình của người dùng
    //     $progress = WizardProgress::where('user_id', $userId)
    //         ->where('bai_viet_id', $id_bai_viet)
    //         ->first();
    
    //     if (!$progress) {
    //         return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
    //     }
    
    //     // Lấy bài viết dựa trên id_bai_viet
    //     $baiViet = BaiViet::find($id_bai_viet);
    
    //     if (!$baiViet || $baiViet->user_id !== $userId) {
    //         return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
    //     }

    //     // Validate file tải lên
    //     $request->validate([
    //         'file' => 'nullable|file|max:2048',
    //     ]);

       
    
    //     // Xử lý file upload nếu có file mới được tải lên
    //     if ($request->hasFile('file')) {
    //         $file = $request->file('file');
    
    //         // Xóa file cũ nếu tồn tại
    //         if ($baiViet->generated_name) {
    //             Storage::disk('public')->delete('uploads/' . $baiViet->generated_name);
    //         }
    
    //         // Tạo tên file mới và lưu trữ file
    //         $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
    //         $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
    //         // Cập nhật thông tin file vào bài viết
    //         $baiViet->update([
    //             'original_name' => $file->getClientOriginalName(),
    //             'generated_name' => $generatedFileName,
    //         ]);
    
    //         return response()->json(['status' => 300,'message' => 'File tải lên thành công và bài viết đã được cập nhật']);
    //     }

    //     return response()->json(['status' => 200,'message' => 'Không có file nào được tải lên'], 200);
    // }

    public function storeStep2(Request $request, $baiVietId = null)
    {
        $userId = Auth::id();
    
        // Kiểm tra người dùng có xác thực hay không
        if (!$userId) {
            return response()->json(['status' => 401, 'error' => 'User not authenticated'], 401);
        }
    
        // Tìm bài viết
        $baiViet = BaiViet::find($baiVietId);
    
        // Kiểm tra bài viết có tồn tại và thuộc về người dùng không
        if (!$baiViet || $baiViet->user_id !== $userId) {
            return response()->json(['status' => 403, 'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }
    
        // Validate các file đã tải lên
        $request->validate([
            'file.*' => 'file|max:2048', // Cho phép nhiều file
        ]);
    
        // Nếu có file mới được tải lên
        if ($request->hasFile('file')) {
            // Lấy tất cả file cũ
            $oldFiles = File::where('id_bai_viet', $baiVietId)->get();
    
            // Xóa tất cả file cũ
            foreach ($oldFiles as $oldFile) {
                $oldFilePath = 'uploads/' . $oldFile->generated_name;
    
                // Xóa file nếu tồn tại
                if (Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }
    
                // Xóa bản ghi trong cơ sở dữ liệu
               File::where('id_bai_viet', $baiVietId)->delete();
            }
    
            // Lưu file mới
            $files = $request->file('file');
    
            // Nếu chỉ một file được tải lên, chuyển đổi nó thành mảng để xử lý nhất quán
            if (!is_array($files)) {
                $files = [$files];
            }
    
            foreach ($files as $file) {
                // Tạo tên file mới
                $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $filePath = $file->storeAs('uploads', $generatedFileName, 'public');
    
                // Tạo hoặc cập nhật thông tin file trong cơ sở dữ liệu
                File::updateOrCreate(
                    ['id_bai_viet' => $baiVietId, 'generated_name' => $generatedFileName],
                    [
                        'file_name' => $file->getClientOriginalName(),
                        'file_path' => $filePath,
                        'file_mime_type' => $file->getMimeType(),
                    ]
                );
            }
    
            return response()->json(['status' => 200, 'message' => 'Các tệp đã được tải lên thành công và bài viết đã được cập nhật']);
        }
    
        return response()->json(['status' => 200, 'message' => 'Không có tệp nào được tải lên'], 200);
    }
    

    
    
    
    
   
    


    
    


    public function storeStep3(Request $request, $id_bai_viet = null)
    {
        $userId = Auth::id();
    
        if (!$userId) {
            return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
        }
    
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'tom_tat' => 'nullable|string|max:250',
            'tu_khoa' => 'nullable|string',
            'citations' => 'string',
        
            'coAuthors' => 'nullable|array',
            'coAuthors.*.name' => 'required|string',
            'coAuthors.*.email' => 'required|email',
            'coAuthors.*.role' => 'required|string',
        ]);
    
        // Lấy tiến trình của người dùng
        $progress = WizardProgress::where('user_id', $userId)
            ->where('bai_viet_id', $id_bai_viet)
            ->first();
    
        if (!$progress) {
            return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
        }
    
        // Lấy bài viết dựa trên id_bai_viet
        $baiViet = BaiViet::find($id_bai_viet);
    
        if (!$baiViet || $baiViet->user_id !== $userId) {
            return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }
    
        // Cập nhật thông tin bài viết
        $baiViet->update([
            'tieu_de' => $request->input('tieu_de'),
            'tom_tat' => $request->input('tom_tat'),
            'citations'=>$request->input('citations'),
        ]);
    
        // Xử lý từ khóa
        if ($request->filled('tu_khoa')) {
            $tuKhoa = preg_split('/\r\n|\r|\n/', $request->input('tu_khoa'));
            foreach ($tuKhoa as $keyword) {
                $keyword = trim($keyword);
                if (!empty($keyword)) {
                    TuKhoa::create([
                        'id_bai_viet' => $baiViet->id_bai_viet,
                        'tu_khoa' => $keyword
                    ]);
                }
            }
        }
    
       // Xử lý đồng tác giả
    if ($request->has('coAuthors')) {
        foreach ($request->input('coAuthors') as $coAuthor) {
            $user = User::where('email', $coAuthor['email'])->first();

            if ($user) {
                // Kiểm tra xem đồng tác giả đã tồn tại hay chưa
                $existingCoAuthor = TacGiaBaiViet::where('id_tac_gia', $user->id)
                    ->where('id_bai_viet', $baiViet->id_bai_viet)
                    ->first();

                if (!$existingCoAuthor) {
                    TacGiaBaiViet::create([
                        'id_tac_gia' => $user->id,
                        'id_bai_viet' => $baiViet->id_bai_viet,
                        'vai_tro' => $coAuthor['role'],
                    ]);
                } else {
                    return response()->json(['status' => 200,'message' => "Đồng tác giả với email: {$coAuthor['email']} đã tồn tại"], 200);
                }
            } else {
                return response()->json(['status' => 404,'error' => "Không tìm thấy người dùng với email: {$coAuthor['email']}"], 404);
            }
        }
    }
    
      
    
        // Cập nhật current_step
        $progress->update(['current_step' => 3]);
    
        return response()->json(['status' => 200,'message' => 'Bước 3 đã lưu thành công'], 200);
    }
    

    public function storeStep4(Request $request, $id_bai_viet = null)
    {
        $userId = Auth::id();

        if (!$userId) {
            return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
        }

        // Lấy tiến trình của người dùng
        $progress = WizardProgress::where('user_id', $userId)
            ->where('bai_viet_id', $id_bai_viet)
            ->first();
    
        if (!$progress) {
            return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
        }
    
        // Lấy bài viết dựa trên id_bai_viet
        $baiViet = BaiViet::find($id_bai_viet);
    
        if (!$baiViet || $baiViet->user_id !== $userId) {
            return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
        }

        $progress->update(['current_step' => 4]);

        return response()->json(['status' => 200,'message' => 'Bước 4 đã lưu thành công'], 200);
    }

    // public function storeStep5(Request $request, $id_bai_viet = null)
    // {
    //     $userId = Auth::id();

    //     if (!$userId) {
    //         return response()->json(['status' => 401,'error' => 'User not authenticated'], 401);
    //     }

    //      // Lấy tiến trình của người dùng
    //      $progress = WizardProgress::where('user_id', $userId)
    //      ->where('bai_viet_id', $id_bai_viet)
    //      ->first();
    
    //     if (!$progress) {
    //         return response()->json(['status' => 404,'error' => 'Tiến trình không tồn tại'], 404);
    //     }
    
    //     // Lấy bài viết dựa trên id_bai_viet
    //     $baiViet = BaiViet::find($id_bai_viet);
    
    //     if (!$baiViet || $baiViet->user_id !== $userId) {
    //         return response()->json(['status' => 403,'error' => 'Bạn không có quyền sửa bài viết này hoặc bài viết không tồn tại'], 403);
    //     }

   
    //     $progress->update(['current_step' => 5]);

    //     return response()->json(['status' => 200,'message' => 'Bước 5 đã hoàn thành và bài viết đã được gửi'], 200);
    // }
}
