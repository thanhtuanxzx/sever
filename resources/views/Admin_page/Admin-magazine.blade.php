<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Quản lý bài viết</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">

</head>

<body>
    <header class="ad_header">
        <h1>Quản lý Bài Viết Tạp Chí Khoa Học</h1>
        <nav class="ad_nav">
            <ul class="ad_nav_list">
                <li><a href="{{ route('admin.dashboard') }}" class="ad_nav_link">Bài viết được gửi về</a></li>
                <li><a href="{{ route('admin.art.rejected') }}" class="ad_nav_link">Bài viết đã từ chối</a></li>
                <li><a href="{{ route('admin.art.done') }}" class="ad_nav_link">Bài viết đã hoàn thành</a></li>
                <li><a href="{{ route('admin.magazine') }}" class="ad_nav_link">Tạo tạp chí</a></li>
                <li><a href="{{ route('magazine.list') }}" class="ad_nav_link">Danh sách tạp chí</a></li>
            </ul>

        </nav>
    </header>

    <main class="ad_main">
        <section class="ad_create_magazine">
            <h2>Tạo Tạp Chí</h2>
            <form>
                <div class="form-group">
                    <label for="magazineTitle">Chuyên mục</label>
                    <select name="category" id="category" class="ad_select" required>
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
                    <label for="magazineIssue">Tập</label>
                    <input type="text" id="magazineIssue" class="form-control" placeholder="Nhập tập" required>
                </div>
                <div class="form-group"></div>
                <label for="magazineIssue">Số</label>
                <input type="text" id="magazineIssue" class="form-control" placeholder="Nhập số" required>
                </div>
                <div class="form-group">
                    <label for="magazineCover">Ảnh Bìa</label>
                    <input type="file" id="magazineCover" class="form-control" required>
                </div>
                <button type="submit" class="ad_btn ad_btn_edit">Tạo Tạp Chí</button>
            </form>
        </section>
    </main>

    <footer class="ad_footer">
        <p>&copy; 2024 Tạp Chí Khoa Học</p>
    </footer>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>

</html>