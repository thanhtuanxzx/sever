<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Tạo Tạp Chí</title>
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
            <h2>Tạo Tạp Chí Mới</h2>
            <form action="#" method="post" class="ad_form">
                <div class="ad_form_group">
                    <label for="categorySelect">Chuyên mục:</label>
                    <select id="categorySelect" class="ad_select">
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
                <div class="ad_form_group">
                    <label for="issueTitle">Tiêu đề Tạp Chí:</label>
                    <input type="text" id="issueTitle" name="issueTitle" class="ad_input"
                        placeholder="Nhập tiêu đề tạp chí">
                </div>
                <div class="ad_form_group">
                    <label for="coverImage">Ảnh bìa:</label>
                    <input type="file" id="coverImage" name="coverImage" class="ad_input">
                </div>
                <div class="ad_form_group">
                    <label for="articleSelect">Chọn bài viết để thêm:</label>
                    <select id="articleSelect" class="ad_select">
                        <!-- Options will be added dynamically -->
                    </select>
                    <button type="button" class="ad_btn ad_btn_add" onclick="addArticle()">Thêm Bài Viết</button>
                </div>
                <div class="ad_form_group">
                    <label for="selectedArticles">Danh sách bài viết đã chọn:</label>
                    <ul id="selectedArticles" class="ad_article_list">
                        <!-- Selected articles will appear here -->
                    </ul>
                </div>
                <button type="submit" class="ad_btn ad_btn_submit">Tạo Tạp Chí</button>
            </form>
        </section>
    </main>

    <footer class="ad_footer">
        <p>&copy; 2024 Tạp Chí Khoa Học</p>
    </footer>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
    <script>
        //Tạo danh sách bài viết 


        // Example article options
        const articles = [
            { id: 1, title: 'Bài viết về AI' },
            { id: 2, title: 'Bài viết về Machine Learning' },
            // Add more articles here
        ];

        // Define a custom event
        const loadtapchiEvent = new Event('loadtapchi');

        document.addEventListener('DOMContentLoaded', function () {
            // Dispatch the custom event when the DOM is ready
            document.dispatchEvent(loadtapchiEvent);
        });

        // Listen for the custom event
        document.addEventListener('loadtapchi', function () {
            const articleSelect = document.getElementById('articleSelect');
            const selectedArticles = document.getElementById('selectedArticles');

            // Populate the select element with article options
            articles.forEach(article => {
                const option = document.createElement('option');
                option.value = article.id;
                option.textContent = article.title;
                articleSelect.appendChild(option);
            });

            window.addArticle = function () {
                const selectedOption = articleSelect.options[articleSelect.selectedIndex];
                if (selectedOption) {
                    const listItem = document.createElement('li');
                    listItem.textContent = selectedOption.textContent;

                    // Create a button to remove the item
                    const removeBtn = document.createElement('button');
                    removeBtn.textContent = 'Xóa';
                    removeBtn.className = 'ad_btn ad_btn_delete';
                    removeBtn.onclick = function () {
                        removeArticle(listItem, selectedOption);
                    };

                    listItem.appendChild(removeBtn);
                    selectedArticles.appendChild(listItem);

                    // Remove the selected article from the dropdown
                    articleSelect.removeChild(selectedOption);
                }
            }

            window.removeArticle = function (listItem, option) {
                // Add the removed article back to the select dropdown
                const newOption = document.createElement('option');
                newOption.value = option.value;
                newOption.textContent = option.textContent;
                articleSelect.appendChild(newOption);

                // Remove the item from the list
                selectedArticles.removeChild(listItem);
            }
        });

    </script>
</body>

</html>