<!-- resources/views/bai_viets/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo bài viết mới</title>
</head>
<body>
    <h1>Tạo bài viết mới</h1>

    <form action="{{ route('bai_viets.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="chu_de">Chủ đề:</label>
            <input type="text" name="chu_de" id="chu_de" required>
        </div>
        <div>
            <label for="tieu_de">Tiêu đề:</label>
            <input type="text" name="tieu_de" id="tieu_de" required>
        </div>
        <div>
            <label for="tom_tat">Tóm tắt:</label>
            <textarea name="tom_tat" id="tom_tat" required></textarea>
        </div>
        <div>
            <label for="noi_dung">Nội dung:</label>
            <textarea name="noi_dung" id="noi_dung" required></textarea>
        </div>
        <div>
            <label for="file">Tập tin:</label>
            <input type="file" name="file" id="file">
        </div>
        <div>
            <button type="submit">Lưu</button>
        </div>
    </form>
</body>
</html>
