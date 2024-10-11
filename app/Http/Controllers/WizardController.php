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

class WizardController extends Controller
{
    // Hiển thị bước 1
    public function step1()
    {
        return view('wizard.step1');
    }

    // Lưu dữ liệu bước 1
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

        // Lưu bai_viet_id vào session
        $request->session()->put('bai_viet_id', $baiViet->id_bai_viet);

        return redirect()->route('wizard.step2');
    }

    // Hiển thị bước 2
    public function step2()
    {
        return view('wizard.step2');
    }

    // Lưu dữ liệu bước 2
    public function storeStep2(Request $request)
    {
        // Lấy tiến trình hiện tại của người dùng
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();

        // Kiểm tra sự tồn tại và trạng thái của tiến trình
        if (!$progress || $progress->current_step < 1) {
            Log::error('Tiến trình không tồn tại cho người dùng.');
            return redirect()->route('wizard.step1')->withErrors(['error' => 'Tiến trình không tồn tại.']);
        }

        // Xác thực dữ liệu tập tin
        $request->validate([
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        // Xử lý khi người dùng tải lên tập tin
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Tạo tên file duy nhất
            $filePath = $file->storeAs('uploads', $fileName, 'public');
            $fileMimeType = $file->getMimeType();

            // Cập nhật thông tin tập tin cho bài viết
            $baiViet = $progress->baiViet;
            $baiViet->update([
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_mime_type' => $fileMimeType,
            ]);

            Log::info('Cập nhật tập tin cho bài viết.', [
                'file_name' => $fileName,
                'file_path' => $filePath,
                'file_mime_type' => $fileMimeType,
            ]);
        }

        // Cập nhật bước hiện tại
        $progress->update(['current_step' => 2]);

        return redirect()->route('wizard.step3');
    }

    // Hiển thị bước 3
    public function step3()
    {
        return view('wizard.step3');
    }

    public function storeStep3(Request $request)
    {
        // Xác thực dữ liệu đầu vào
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

        // Lấy tiến trình hiện tại của người dùng
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $baiViet = $progress->baiViet;

        // Kiểm tra bài viết
        if (!$baiViet || !$baiViet->id_bai_viet) {
            return redirect()->route('wizard.step1')->withErrors(['error' => 'Bài viết không tồn tại hoặc ID bài viết không hợp lệ.']);
        }

        // Cập nhật thông tin bài viết
        $baiViet->update([
            'tieu_de' => $request->input('tieu_de'),
            'tom_tat' => $request->input('tom_tat'),
        ]);

        // Xử lý từ khóa
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

        // Xử lý danh sách đồng tác giả
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
                    // Dừng lại và hiển thị thông báo lỗi nếu không tìm thấy người dùng
                    return redirect()->back()->with('error', "Không tìm thấy người dùng với email: {$coAuthor['email']}");
                }
            }
        
           
        }
        
        

        // Xử lý trích dẫn
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

        return redirect()->route('wizard.step4');
    }

    // Hiển thị bước 4
    public function step4()
    {
        return view('wizard.step4');
    }

    // Lưu dữ liệu bước 4
    public function storeStep4(Request $request)
    {
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $progress->update(['current_step' => 4]);

        return redirect()->route('wizard.step5');
    }

    // Hiển thị bước 5
    public function step5()
    {
        return view('wizard.step5');
    }

    // Lưu dữ liệu bước 5
    public function storeStep5(Request $request)
    {
        $progress = WizardProgress::where('user_id', Auth::id())->orderBy('created_at', 'desc')->first();
        $progress->update(['current_step' => 5]);

        $request->session()->forget(['bai_viet_id', 'step1', 'step2', 'step3', 'step4', 'step5']);

        return redirect()->route('Submissions');
    }

    // Hiển thị trang hoàn thành
    public function completed()
    {
        return view('Submissions');
    }
}
