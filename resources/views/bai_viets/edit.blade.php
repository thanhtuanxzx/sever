<!-- resources/views/bai_viets/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa bài viết</title>
</head>
<body>
    <h1>Sửa bài viết</h1>

    <form action="{{ route('bai_viets.update', $baiViet->id_bai_viet) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="chu_de">Chủ đề:</label>
            <input type="text" name="chu_de" id="chu_de" value="{{ $baiViet->chu_de }}" required>
        </div>
        <div>
            <label for="tieu_de">Tiêu đề:</label>
            <input type="text" name="tieu_de" id="tieu_de" value="{{ $baiViet->tieu_de }}" required>
        </div>
        <div>
            <label for="tom_tat">Tóm tắt:</label>
            <textarea name="tom_tat" id="tom_tat" required>{{ $baiViet->tom_tat }}</textarea>
        </div>
        <div>
            <label for="noi_dung">Nội dung:</label>
            <textarea name="noi_dung" id="noi_dung" required>{{ $baiViet->noi_dung }}</textarea>
        </div>
        <div>
            <label for="file">Tập tin (nếu có):</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <button type="submit">Cập nhật</button>
        </div>
    </form>
</body>
</html>
