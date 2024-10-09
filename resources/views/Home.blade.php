<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Test Form</title>
</head>
<body>
    <div class="container">
        <h2>Gửi Bài Viết</h2>
        <form action="/test" method="POST">
            @csrf
            <div class="form-group">
                <label for="chu_de">Chuyên mục</label>
                <select class="form-control" name="chu_de" id="chu_de">
                    <option value="16">Công nghệ</option>
                    <option value="2" selected="selected">Công nghệ thông tin</option>
                    <option value="3">Môi trường</option>
                    <option value="4">Tự nhiên</option>
                    <option value="6">Công nghệ sinh học</option>
                    <option value="7">Công nghệ thực phẩm</option>
                    <option value="1">Khoa học Chính trị</option>
                    <option value="10">Xã hội-Nhân văn</option>
                    <option value="13">Kinh tế</option>
                    <option value="15">Luật</option>
                </select>
            </div>

            <div class="form-group">
                <label for="ghichu">Ghi chú cho biên tập viên</label>
                <input type="text" class="form-control" name="ghichu" id="ghichu" required>
            </div>

            <button type="submit" class="btn btn-primary">Gửi</button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
