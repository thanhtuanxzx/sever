<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\BaiViet;
use App\Models\WizardProgress;
use App\Models\User;
use App\Models\TuKhoa;
use App\Models\Citation;
use App\Models\TacGiaBaiViet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File; // Thêm dòng này
use Illuminate\Http\JsonResponse;

class WizardController extends Controller
{
    // API cho bước 1
    public function storeStep1(Request $request)
    {
        $request->validate([
            'chu_de' => 'required|string|max:255',
            'ghichu' => 'nullable|string',
        ]);

        // Tạo bài viết mới
        $baiViet = BaiViet::create([
            'chu_de' => $request->input('chu_de'),
            'ghichu' => $request->input('ghichu'),
        ]);

        // Tạo tiến trình mới
        WizardProgress::create([
            'user_id' => Auth::id(),
            'bai_viet_id' => $baiViet->id_bai_viet,
            'current_step' => 1
        ]);

        return response()->json([
            'message' => 'Bước 1 đã lưu thành công',
            'bai_viet_id' => $baiViet->id_bai_viet
        ], 201);
    }

   // API cho bước 2 - Upload file và cập nhật thông tin bài viết
   public function storeStep2(Request $request)
   {
        
       // Tìm tiến trình của người dùng
       $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();

       if (!$progress || $progress->current_step < 1) {
           return response()->json(['error' => 'Tiến trình không tồn tại'], 404);
       }

       // Lấy bài viết dựa trên tiến trình
       $baiViet = BaiViet::find($progress->bai_viet_id);
       if (!$baiViet) {
           return response()->json(['error' => 'Bài viết không tồn tại'], 404);
       }

       // Validate file tải lên
       $request->validate([
           'file' => 'nullable|file|max:2048', // Chấp nhận các loại file và tối đa 2MB
       ]);

       // Xử lý file upload
       if ($request->hasFile('file')) {
           $file = $request->file('file');
           
           // Tạo tên file mới ngẫu nhiên
           $generatedFileName = Str::random(20) . '.' . $file->getClientOriginalExtension();

           // Lưu file vào thư mục 'uploads' trong public disk
           $filePath = $file->storeAs('uploads', $generatedFileName, 'public');

           // Cập nhật thông tin file vào bài viết
           $baiViet->update([
               'original_name' => $file->getClientOriginalName(),
               'generated_name' => $generatedFileName,
           ]);

           return response()->json(['message' => 'File tải lên thành công và bài viết đã được cập nhật']);
       }

       return response()->json(['message' => 'Không có file nào được tải lên'], 200);
   }



    // API cho bước 3
    public function storeStep3(Request $request)
    {
        $request->validate([
            'tieu_de' => 'required|string|max:255',
            'tom_tat' => 'nullable|string|max:250',
            'tu_khoa' => 'nullable|string',
            'citations' => 'nullable|array',
            'citations.*.title' => 'required|string|max:255',
            'citations.*.link' => 'required|url',
            'coAuthors' => 'nullable|array',
            'coAuthors.*.name' => 'required|string',
            'coAuthors.*.email' => 'required|email',
            'coAuthors.*.role' => 'required|string',
        ]);

        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $baiViet = $progress->baiViet;

        if (!$baiViet || !$baiViet->id_bai_viet) {
            return response()->json(['error' => 'Bài viết không tồn tại'], 404);
        }

        $baiViet->update([
            'tieu_de' => $request->input('tieu_de'),
            'tom_tat' => $request->input('tom_tat'),
        ]);

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

        if ($request->has('coAuthors')) {
            foreach ($request->input('coAuthors') as $coAuthor) {
                $user = User::where('email', $coAuthor['email'])->first();

                if ($user) {
                    TacGiaBaiViet::create([
                        'id_tac_gia' => $user->id,
                        'id_bai_viet' => $baiViet->id_bai_viet,
                        'vai_tro' => $coAuthor['role'],
                    ]);
                } else {
                    return response()->json(['error' => "Không tìm thấy người dùng với email: {$coAuthor['email']}"], 404);
                }
            }
        }

        if ($request->has('citations')) {
            foreach ($request->input('citations') as $citation) {
                Citation::create([
                    'id_bai_viet' => $baiViet->id_bai_viet,
                    'title' => $citation['title'],
                    'link' => $citation['link'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $progress->update(['current_step' => 3]);

        return response()->json(['message' => 'Bước 3 đã lưu thành công'], 200);
    }

    // API cho bước 4
    public function storeStep4(Request $request)
    {
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $progress->update(['current_step' => 4]);

        return response()->json(['message' => 'Bước 4 đã lưu thành công'], 200);
    }

    // API cho bước 5
    public function storeStep5(Request $request)
    {
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $progress->update(['current_step' => 5]);

        return response()->json(['message' => 'Bài viết đã hoàn thành'], 200);
    }

    // API hoàn thành
    public function completed()
    {
        return response()->json(['message' => 'Hoàn thành wizard'], 200);
    }
}
