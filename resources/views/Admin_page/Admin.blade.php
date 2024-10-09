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
        <section class="ad_search">
            <input type="text" id="searchInput" class="ad_search_input" placeholder="Tìm kiếm bài viết...">
        </section>
        <section class="ad_article_management">
            <h2>Bài viết được gửi về</h2>
            <table class="ad_table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tiêu Đề</th>
                        <th>Tác Giả</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody id="table-body">
                    <tr>
                        <td>1</td>
                        <td><a href="" class="ad_article_link">Nghiên cứu về AI</a></td>
                        <td>Nguyễn Văn A</td>
                        <td>Chờ Xét Duyệt</td>
                        <td>
                            <a href="/admin/article-details" class="ad_btn ad_btn_edit">Xem chi tiết</a>
                            <a href="#" class="ad_btn ad_btn_delete">Xóa</a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </section>
    </main>

    <footer class="ad_footer">
        <p>&copy; 2024 Tạp Chí Khoa Học</p>
    </footer>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>

</html>