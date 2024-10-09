<!-- resources/views/bai_viets/show.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết bài viết</title>
</head>
<body>
    <h1>{{ $baiViet->tieu_de }}</h1>
    <p><strong>Chủ đề:</strong> {{ $baiViet->chu_de }}</p>
    <p><strong>Tóm tắt:</strong> {{ $baiViet->tom_tat }}</p>
    <p><strong>Nội dung:</strong> {{ $baiViet->noi_dung }}</p>
    <p><strong>Ngày gửi:</strong> {{ $baiViet->ngay_gui }}</p>
    <p><strong>Ngày chấp nhận:</strong> {{ $baiViet->ngay_chap_nhan }}</p>
    <p><strong>Trạng thái:</strong> {{ $baiViet->trang_thai }}</p>

    @if($baiViet->file_path)
        <p><strong>Tập tin:</strong> <a href="{{ Storage::url($baiViet->file_path) }}" target="_blank">Xem tập tin</a></p>
    @endif   

    <a href="{{ route('bai_viets.index') }}">Quay lại</a>
</body>
</html>
