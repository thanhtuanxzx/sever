<?php

// app/Http/Controllers/BaiVietController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BaiViet;
use Illuminate\Support\Facades\Storage;

class BaiVietController extends Controller
{
    public function index()
    {
        $baiViets = BaiViet::all(); // Lấy tất cả bài viết
        return view('bai_viets.index', compact('baiViets'));
    }

    public function create()
    {
        return view('bai_viets.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'chu_de' => 'required|string',
            'ghichu'=> 'required|string',
            'tieu_de' => 'required|string',
            'tom_tat' => 'required|string',
            'noi_dung' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $data = $request->only([
            'chu_de', 'ghichu', 'tieu_de', 'tom_tat', 'noi_dung', 'ngay_gui', 'ngay_chap_nhan', 'trang_thai', 'tap'
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_path'] = $file->store('uploads', 'public');
            $data['file_mime_type'] = $file->getMimeType();
        }

        BaiViet::create($data);

        return redirect()->route('bai_viets.index')->with('success', 'Bài viết đã được tạo thành công.');
    }

    public function show($id)
    {
        $baiViet = BaiViet::where('id_bai_viet', $id)->first();

        return view('bai_viets.show', compact('baiViet'));
    }

    public function edit($id)
    {
        $baiViet = BaiViet::where('id_bai_viet', $id)->first();

        return view('bai_viets.edit', compact('baiViet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'chu_de' => 'required|string',
            'tieu_de' => 'required|string',
            'tom_tat' => 'required|string',
            'noi_dung' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
        ]);

        $baiViet = BaiViet::where('id_bai_viet', $id)->first();

        $data = $request->only([
            'chu_de', 'ghichu', 'tieu_de', 'tom_tat', 'noi_dung', 'ngay_gui', 'ngay_chap_nhan', 'trang_thai', 'tap'
        ]);

        if ($request->hasFile('file')) {
            // Xóa tập tin cũ nếu có
            if ($baiViet->file_path) {
                Storage::delete('public/' . $baiViet->file_path);
            }

            $file = $request->file('file');
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_path'] = $file->store('uploads', 'public');
            $data['file_mime_type'] = $file->getMimeType();
        }

        $baiViet->update($data);

        return redirect()->route('bai_viets.index')->with('success', 'Bài viết đã được cập nhật thành công.');
    }

    public function destroy($id)
{
    $baiViet = BaiViet::where('id_bai_viet', $id)->first();
    if ($baiViet) {
        $baiViet->delete();
        return redirect()->route('bai_viets.index')->with('success', 'Bài viết đã được xóa thành công.');
    } else {
        return redirect()->route('bai_viets.index')->with('error', 'Bài viết không tồn tại.');
    }
}

}
