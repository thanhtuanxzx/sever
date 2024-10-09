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
                <div class="nav-item-hidden">

                </div>
            </div>
        </div>

        <div class="right-group">
            <a href="/index" class="nav-item" class="right-group">
                <span class="fa fa-eye"></span>
                Xem trang

            </a>

            <li class="nav-item" class="right-group">
                @auth
                    <div class="nav-link">
                        <a href="#"><i class="fa-solid fa-user"></i><span
                                style="margin-right: 4px;"></span>{{ Auth::user()->username }}<span class="badge">0</span><i
                                class="fa-solid fa-sort-down"></i></a>
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


                <form class="pkp_ui_content" action="{{ route('wizard.step3') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="pkp_ui_textfill_div">
                        <h5>Tiêu đề</h5>
                        <input type="text" name="tieu_de" id="" required>
                    </div>
                        
                    
                    

                    <div class="pkp_ui_textfill_div">
                        <h5>Tóm tắt</h5>
                        <p>Phần tóm tắt phải có 250 từ trở xuống.</p>
                        <input type="text" name="tom_tat" id="" required>
                    </div>
                    

                    <div class="pkp_ui_textfill_div">
                        <h5>Từ khóa</h5>
                        <p>Thêm thông tin bổ sung cho bài nộp của bạn. Nhấn 'enter' sau mỗi thuật ngữ.</p>
                        <input type="text" name="tu_khoa" id="" required>
                    </div>


                    <div class="">
                        <div class="header">
                            <h4>Danh sách Đồng Tác Giả</h4>
                            <ul>
                                <li>
                                    <a href="#" title="Thêm tác giả" onclick="showPopup(1)">Thêm đồng tác giả</a>
                                </li>
                            </ul>
                        </div>
    
    
                        <table id="danhSachDongTacGia" class="pkp_ui_author_table">
                            <colgroup>
                                <col style="width: 20%;">
                                <col style="width: 40%;">
                                <col style="width: 10%;">
                                <col style="width: 5%">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Vai trò</th>
                                    <th scope="col" style="border: none;"></th>
                                </tr>
                            </thead>
                            <tbody>
    
                                <tr>
                                    <td>
                                        <span>{{{Auth::user()->first_name }}}</span>
                                    </td>
                                    <td>
                                        <span>{{{Auth::user()->email }}}</span>
                                    </td>
    
                                    <td>
                                        @if (Auth::user() && Auth::user()->tacGiaBaiViet)
                                            <span>{{ Auth::user()->tacGiaBaiViet->vai_tro }}</span>
                                        @else
                                            <span>Không có thông tin vai trò</span>
                                        @endif
                                    </td>
                                    
                                </tr>
    
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-5"> 
                        <h5>Thêm trích dẫn tài liệu tham khảo</h5>
                        <a href="#" onclick="showPopup(2)">Trích dẫn tài liệu tham khảo</a>
                    </div>
                    <table class="pkp_ui_references_Table" id="citationsTable" border="1">
                        <colgroup>
                            <col style="width: 30%;">
                            <col style="width: 67%;">
                            
                        </colgroup>
                        <thead>
                            <tr>
                                <th>Tiêu đề</th>
                                <th>Liên kết</th>
                            </tr>
                        </thead>
                        <tbody class="pkp_ui_references_tbody">
                            <!-- Các trích dẫn sẽ được thêm vào đây -->
                        </tbody>
                    </table>
                    <input type="text" id="email" name="name" value=" {{Auth::user()->first_name }}">
                    <div class="section formButtons form_buttons">
                        <button class="pkp_button submitFormButton" type="submit">
                            Lưu và tiếp tục
                        </button>

                        <span></span>

                        <a href="#" class="cancelButton">
                            Hủy bỏ
                        </a>
                    </div>
                </form>







                




                <div class="overlay" id="overlay1">
                    <div class="popup">
                        <h3>Thêm đồng tác giả</h3>
                        <form id="authorForm">
                            <div class="pkp_ui_textfill_div">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="pkp_ui_textfill_div">
                                <label for="name">Tên:</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="pkp_ui_textfill_div">
                                <label><strong>Vai trò:</strong></label><br>
                                <input type="radio" id="vaitro1" name="option" value="option1" required>
                                <label for="option1">Đồng tác giả</label><br>
                                <input type="radio" id="vaitro2" name="option" value="option2">
                                <label for="option2">Phản biện</label>
                            </div>
                            <button type="submit" class="submit-btn">Xác nhận thêm tác giả</button>
                        </form>
                        <button onclick="closePopup(1)">Đóng</button>
                    </div>
                </div>

                <div class="overlay" id="overlay2">
                    <div class="popup">
                        <h3>Thêm trích dẫn tài liệu tham khảo</h3>
                        <form id="citationForm">
                            <div id="pkp_ui_references_citation-form">
                                <div class="pkp_ui_references_citation-form">
                                    <label for="title[]">Tiêu đề</label>
                                    <input type="text" name="titles[]" class="pkp_ui_references_form-control" required>
                                </div>
                                <div class="pkp_ui_references_citation-form">
                                    <label for="link[]">Liên kết</label>
                                    <input type="url" name="links[]" class="pkp_ui_references_form-control" required>
                                </div>
                            </div>
                            <button type="button" class="pkp_ui_references_btn" id="add-citation">Thêm trích dẫn mới</button>
                            <button type="button" class="pkp_ui_references_btn" id="save-citations">Lưu tất cả</button>
                        </form>                    
                        <button onclick="closePopup(2)">Đóng</button>
                    </div>
                </div>

                





            
            </div>
        </div>
    </div>


    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>



</html>