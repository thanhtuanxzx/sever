<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chi Tiết Tạp Chí</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <header class="ad_header">
        <h1>Chi Tiết Tạp Chí</h1>
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
        <section class="ad_magazine_details">
            <h2>Thông Tin Tạp Chí</h2>
            <div class="ad_magazine_info">
                <h3>Tiêu Đề: Tạp Chí Khoa Học số 1</h3>
                <p><strong>Tập và Số:</strong> Tập 1, Số 1</p>
                <p><strong>Ngày Xuất Bản:</strong> 01/01/2024</p>
                <img src="cover1.jpg" alt="Ảnh Bìa" class="ad_cover_image">
            </div>

            <section class="ad_article_list">
                <h3>Danh Sách Bài Viết</h3>
                <table class="ad_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tiêu Đề</th>
                            <th>Tác Giả</th>
                            <th>Hành Động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Bài viết về AI</td>
                            <td>Nguyễn Văn A</td>
                            <td><a href="#" class="ad_btn ad_btn_edit">Chỉnh sửa</a></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Bài viết về Machine Learning</td>
                            <td>Trần Thị B</td>
                            <td><a href="#" class="ad_btn ad_btn_edit">Chỉnh sửa</a></td>
                        </tr>
                        <!-- Thêm các bài viết khác ở đây -->
                    </tbody>
                </table>
            </section>
        </section>
    </main>

    <footer class="ad_footer">
        <p>&copy; 2024 Tạp Chí Khoa Học</p>
    </footer>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>

</html>