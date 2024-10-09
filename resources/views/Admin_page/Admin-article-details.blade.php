<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Chi Tiết Bài Viết</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body>
    <header class="ad_header">
        <h1>Chi Tiết Bài Viết</h1>
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
        <section class="ad_article_details">
            <h2>Chi Tiết Bài Viết</h2>
            <div class="ad_form_group">
                <label for="articleTitle">Tiêu Đề:</label>
                <input type="text" id="articleTitle" class="form-control" value="Nghiên cứu về AI" disabled>
            </div>
            <div class="ad_form_group">
                <label for="articleCategory">Chuyên Mục:</label>
                <input type="text" id="articleCategory" class="form-control" value="Công nghệ thông tin" disabled>
            </div>
            <div class="ad_form_group">
                <label for="articleSummary">Tóm Tắt:</label>
                <textarea id="articleSummary" class="form-control" rows="5"
                    disabled>Nội dung tóm tắt của bài viết về AI.</textarea>
            </div>
            <div class="ad_form_group">
                <label for="articleKeywords">Từ Khóa:</label>
                <input type="text" id="articleKeywords" class="form-control" value="AI, Machine Learning, Deep Learning"
                    disabled>
            </div>
            <div class="ad_form_group">
                <label for="articleAuthors">Tác Giả:</label>
                <table class="ad_table">
                    <thead>
                        <tr>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Vai Trò</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nguyễn Văn A</td>
                            <td>a.nguyen@example.com</td>
                            <td>Tác Giả Chính</td>
                        </tr>
                        <tr>
                            <td>Trần Thị B</td>
                            <td>b.tran@example.com</td>
                            <td>Đồng Tác Giả</td>
                        </tr>
                        <!-- Thêm các tác giả khác ở đây -->
                    </tbody>
                </table>
            </div>
            <div class="ad_form_group">
                <label for="articleReferences">Danh Sách Trích Dẫn:</label>
                <ul>
                    <li>Smith, J. (2023). "Introduction to AI". Journal of Technology.</li>
                    <li>Brown, L. (2022). "Advanced Machine Learning". Tech Press.</li>
                    <!-- Thêm các trích dẫn khác ở đây -->
                </ul>
            </div>
        </section>
    </main>

    <footer class="ad_footer">
        <p>&copy; 2024 Tạp Chí Khoa Học</p>
    </footer>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>

</html>