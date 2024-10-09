<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Layout</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
</head>

<body id="mainBody">
    <div id="navigationUserWrapper">
        <div class="left-group">
            <header class="nav-item">
                Tạp chí khoa học Trường đại học kỹ thuật - công nghệ Cần Thơ
            </header>
            <div class="nav-item">
                <div class="nav-link"><a href="">Công việc</a></div>
                <div class="nav-item-hidden"></div>
            </div>
        </div>

        <div class="right-group">
            <a href="/index" class="nav-item">
                <span class="fa fa-eye"></span>
                Xem trang
            </a>

            <li class="nav-item">
                @auth
                    <div class="nav-link">
                        <a href="#"><i class="fa-solid fa-user"></i><span style="margin-right: 4px;"></span>{{ Auth::user()->username }}<span class="badge">0</span><i class="fa-solid fa-sort-down"></i></a>
                    </div>
                    <div class="nav-item-hidden" style="display: none;">
                        <a href="#">Hồ sơ cá nhân</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Đăng xuất</button>
                        </form>
                    </div>
                @else
                    <div class="nav-link">
                        <a href="{{ url('/login') }}">Đăng nhập</a>
                    </div>
                @endauth
            </li>
        </div>
    </div>

    <div class="pkp_structure_main">
        <div class="pkp_structure_coldum">
            <img src="{{ asset('img/logo.png') }}" alt="">
            <a href="#" class=""><span style="margin-right: 4px;"><i class="fa-solid fa-box"></i></span>Các bài báo</a>
        </div>

        <div class="pkp_structure_content">
            <div class="pkp_page_title">
                <h3>Gửi một bài báo mới</h3>
            </div>
            <div class="pkpTabs">
                <div class="tabs-list">
                    <a href="/wizard/step1"><button>Bắt đầu</button></a>
                    <a href="/wizard/step2"><button>Tải lên bài nộp</button></a>
                    <a href="/wizard/step3"><button>Nhập dữ liệu</button></a>
                    <a href="/wizard/step4"><button>Xác nhận</button></a>
                    <a href="/wizard/step5"><button>Lưu trữ</button></a>
                </div>

                <div class="container">
                    <h2>Thông Tin Bài Viết</h2>
                    <form action="{{ route('wizard.step3') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="tieu_de" class="form-label">Tiêu đề</label>
                            <input type="text" class="form-control" id="tieu_de" name="tieu_de" required>
                        </div>

                        <div class="mb-3">
                            <label for="tom_tat" class="form-label">Tóm tắt</label>
                            <textarea class="form-control" id="tom_tat" name="tom_tat" rows="3" maxlength="250"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="tu_khoa" class="form-label">Từ khóa</label>
                            <!-- <input type="text" class="form-control" id="tu_khoa" name="tu_khoa" placeholder="Nhập từ khóa mỗi từ một dòng"> -->
                            <textarea class="form-control" id="tu_khoa" name="tu_khoa" rows="3" maxlength="250"></textarea>
                        </div>

                        <h4>Danh Sách Đồng Tác Giả</h4>
                        <div id="coAuthorsContainer">
                            <div class="mb-3 co-author-item">
                                <input type="text" class="form-control" name="coAuthors[0][name]" placeholder="Tên" required>
                                <input type="email" class="form-control" name="coAuthors[0][email]" placeholder="Email" required>
                                <select class="form-select" name="coAuthors[0][role]" required>
                                    <option value="co_author">Đồng tác giả</option>
                                    <option value="reviewer">Phản biện</option>
                                </select>
                                <span class="remove-btn" onclick="removeCoAuthor(this)">Xóa</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-2" onclick="addCoAuthor()">Thêm Đồng Tác Giả</button>

                        <h3>Trích Dẫn Tài Liệu Tham Khảo</h3>
                        <div id="citationList">
                            <div class="mb-3 citation-item">
                                <input type="text" class="form-control" name="citations[0][title]" placeholder="Tiêu đề" required>
                                <input type="url" class="form-control" name="citations[0][link]" placeholder="Liên kết" required>
                                <span class="remove-btn" onclick="removeCitation(this)">Xóa</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary mt-2" onclick="addCitation()">Thêm Trích Dẫn</button>

                        <button type="submit" class="btn btn-success mt-3">Lưu và Tiếp Tục</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        let coAuthorIndex = 1;
        let citationIndex = 1;

        function addCoAuthor() {
            const coAuthorsContainer = document.getElementById('coAuthorsContainer');
            const newCoAuthor = document.createElement('div');
            newCoAuthor.className = 'mb-3 co-author-item';
            newCoAuthor.innerHTML = `
                <input type="text" class="form-control" name="coAuthors[${coAuthorIndex}][name]" placeholder="Tên" required>
                <input type="email" class="form-control" name="coAuthors[${coAuthorIndex}][email]" placeholder="Email" required>
                <select class="form-select" name="coAuthors[${coAuthorIndex}][role]" required>
                    <option value="co_author">Đồng tác giả</option>
                    <option value="reviewer">Phản biện</option>
                </select>
                <span class="remove-btn" onclick="removeCoAuthor(this)">Xóa</span>
            `;
            coAuthorsContainer.appendChild(newCoAuthor);
            coAuthorIndex++;
        }

        function removeCoAuthor(element) {
            const coAuthorsContainer = document.getElementById('coAuthorsContainer');
            coAuthorsContainer.removeChild(element.parentElement);
        }

        function addCitation() {
            const citationList = document.getElementById('citationList');
            const newCitation = document.createElement('div');
            newCitation.className = 'mb-3 citation-item';
            newCitation.innerHTML = `
                <input type="text" class="form-control" name="citations[${citationIndex}][title]" placeholder="Tiêu đề" required>
                <input type="url" class="form-control" name="citations[${citationIndex}][link]" placeholder="Liên kết" required>
                <span class="remove-btn" onclick="removeCitation(this)">Xóa</span>
            `;
            citationList.appendChild(newCitation);
            citationIndex++;
        }

        function removeCitation(element) {
            const citationList = document.getElementById('citationList');
            citationList.removeChild(element.parentElement);
        }
    </script>
</body>
</html>
