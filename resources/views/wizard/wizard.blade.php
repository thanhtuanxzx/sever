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

    <style>
         /* Lớp overlay mờ */
        .overlay {
            display: none; /* Ẩn mặc định */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7); /* Màu đen mờ */
            z-index: 999; /* Hiển thị lên trên */
        }

        /* CSS cho div được hiển thị khi nhấn vào link */
        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            z-index: 1000; /* Hiển thị lên trên lớp overlay */
        }

        /* Làm mờ toàn bộ trang */
        .blur {
            filter: blur(5px); /* Mức độ làm mờ */
        }
    </style>
</head>
<body>
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
            <img src="/ass/img/logo.png" alt="">
            <a href="#" class=""><span style="margin-right: 4px;"><i class="fa-solid fa-box"></i></span>Các bài báo</a>
        </div>
    
        <div class="pkp_structure_content">
            <div class="pkp_page_title">
                <h3>Gửi một bài báo mới</h3>
            </div>
            <div class="pkpTabs">
                <div class="tabs-list">
                    <button onclick="showContext('step1'); return false;">Bắt đầu</button>
                    <button onclick="showContext('step2'); return false;">Tải lên bài nộp</button>
                    <button onclick="showContext('step3'); return false;">Nhập dữ liệu</button>
                    <button onclick="showContext('step4'); return false;">Xác nhận</button>
                    <button onclick="showContext('step5'); return false;">Lưu trữ</button>
                </div>

                <div id="step1" class="context active">
                <form class="pkp_ui_content" action="{{ route('wizard.step1') }}" method="POST">
                    @csrf
                    <h5>Chuyên mục</h5>
                    <select class="pkp_ui_select" name="chu_de">
                        <option value="16" {{ old('chu_de', $baiViet->chu_de ?? '') == 16 ? 'selected' : '' }}>Công nghệ
                        </option>
                        <option value="2" {{ old('chu_de', $baiViet->chu_de ?? '') == 2 ? 'selected' : '' }}>Công nghệ
                            thông tin</option>
                        <option value="3" {{ old('chu_de', $baiViet->chu_de ?? '') == 3 ? 'selected' : '' }}>Môi trường
                        </option>
                        <option value="4" {{ old('chu_de', $baiViet->chu_de ?? '') == 4 ? 'selected' : '' }}>Tự nhiên
                        </option>
                        <option value="6" {{ old('chu_de', $baiViet->chu_de ?? '') == 6 ? 'selected' : '' }}>Công nghệ
                            sinh học</option>
                        <option value="7" {{ old('chu_de', $baiViet->chu_de ?? '') == 7 ? 'selected' : '' }}>Công nghệ
                            thực phẩm</option>
                        <option value="1" {{ old('chu_de', $baiViet->chu_de ?? '') == 1 ? 'selected' : '' }}>Khoa học
                            Chính trị</option>
                        <option value="10" {{ old('chu_de', $baiViet->chu_de ?? '') == 10 ? 'selected' : '' }}>Xã hội-Nhân
                            văn</option>
                        <option value="13" {{ old('chu_de', $baiViet->chu_de ?? '') == 13 ? 'selected' : '' }}>Kinh tế
                        </option>
                        <option value="15" {{ old('chu_de', $baiViet->chu_de ?? '') == 15 ? 'selected' : '' }}>Luật
                        </option>
                    </select>



                    <h5>Yêu cầu của bài nộp</h5>
                    <p>Bạn phải đọc và xác nhận rằng bạn đã hoàn thành các yêu cầu bên dưới trước khi tiếp tục.</p>
                    <ul class="checkbox_and_radiobutton">
                        <li>
                            <label>
                                <input type="checkbox" id="checklist-0" value="1" name="checklist[]" {{ in_array(1, old('checklist', $baiViet->checklist ?? [])) ? 'checked' : '' }}>
                                Bài gửi chưa được xuất bản trước đó, hoặc đang gửi cho một tạp chí khác xem xét
                                (hoặc một lời giải thích đã được cung cấp trong Nhận xét cho Biên tập viên).
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" id="checklist-1" value="2" name="checklist[]" {{ in_array(2, old('checklist', $baiViet->checklist ?? [])) ? 'checked' : '' }}>
                                Tập tin bài gửi ở định dạng tệp tài liệu OpenOffice, Microsoft Word hoặc RTF.
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" id="checklist-3" value="3" name="checklist[]" {{ in_array(3, old('checklist', $baiViet->checklist ?? [])) ? 'checked' : '' }}>
                                Các văn bản là khoảng cách đơn; sử dụng phông chữ 12; sử dụng chữ nghiêng, thay vì gạch
                                chân
                                (trừ địa chỉ URL); và tất cả các hình minh họa, số liệu và bảng được đặt
                                trong văn bản tại các điểm thích hợp, thay vì ở cuối bản thảo.
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" id="checklist-4" value="4" name="checklist[]" {{ in_array(4, old('checklist', $baiViet->checklist ?? [])) ? 'checked' : '' }}>
                                Văn bản tuân thủ các yêu cầu về trình bày văn bản và tài liệu tham khảo được nêu
                                trong Hướng dẫn cho tác giả.
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="checkbox" id="checklist-5" value="5" name="checklist[]" {{ in_array(5, old('checklist', $baiViet->checklist ?? [])) ? 'checked' : '' }}>
                                Tác giả liên hệ gửi bài phải nhập đầy đủ thông tin của bài viết vào các trường dữ
                                liệu tương ứng theo 2 ngôn ngữ tiếng Việt và tiếng Anh (Danh sách tác giả khi khai
                                báo phải giống thứ tự tác giả trong tập tin).
                            </label>
                        </li>
                    </ul>


                    <h5>Ghi chú cho biên tập viên</h5>
                    <input type="text" name="ghichu" value="{{ old('ghichu', $baiViet->ghichu ?? '') }}" required>

                    <ul class="checkbox_and_radiobutton" style="list-style-type: none;">
                        <li>
                            <label>
                                <input type="checkbox" id="privacyConsent" required="1" value="1" validation="required"
                                    name="privacyConsent" class="field checkbox required" checked="checked"
                                    aria-required="true">
                                Đồng ý thu thập và lưu trữ dữ liệu cá nhân theo
                                <a href="" target="_blank">cam kết bảo mật</a>.
                            </label>
                        </li>
                    </ul>

                    <div class="section formButtons form_buttons">
                        <button class="pkp_button submitFormButton" type="submit">
                            Lưu và tiếp tục
                        </button>
                    </div>
                </form>
                </div>
                
                <div id="step2" class="context">
                <form class="pkp_ui_content" action="{{ route('wizard.step2') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="file">Tập tin:</label>

                       
                         <input type="file" name="file" id="file">
                    </div> 


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

                <div id="step3" class="context active" id="mainBody">
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
                    <div class="overlay" id="overlay">
                        <div class="popup">
                            <h2>Popup</h2>
                            <p>Đây là nội dung của popup.</p>
                            <button onclick="closePopup()">Đóng</button>
                        </div>
                    </div>
                </div>

                <div id="step4" class="context">
                <form class="pkp_ui_content" action="{{ route('wizard.step4') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <p>Bài nộp của bạn đã được lưu lại và sẵn sàng để gửi lên cho tạp chí. Bạn có thể quay lại để
                        xem xét và điều chỉnh bất kỳ thông tin nào bạn đã nhập trước khi tiếp tục. Nếu bạn đã sẵn
                        sàng, hãy nhấp vào "Hoàn thành bài nộp" để gửi bài báo đến cho tạp chí.</p>
                    <div class="section formButtons form_buttons">
                        <button class="pkp_button submitFormButton" type="submit">
                            Hoàn thành và xác nhận
                        </button>

                        <span></span>

                        <a href="#" class="cancelButton">
                            Hủy bỏ
                        </a>
                    </div>
                </form>
                            
                </div>

                <div id="step5" class="context">
                <form class="pkp_ui_content" action="{{ route('wizard.step5') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <h5>Hoàn thành việc gửi bài</h5>
                    <p>Cảm ơn bạn đã nộp bài vào Tạp chí Khoa học Đại học Kỹ thuật - Công nghệ Cần Thơ.</p>

                    <span></span>

                    <p>Ban biên tập đã nhận được thông báo về bài nộp của bạn và bạn cũng đã được gửi email xác nhận
                        cho bài nộp của mình. Khi ban biên tập xem xét nội dung bài nộp, họ sẽ liên hệ với bạn sau.
                    </p>

                    <ul>
                    <button class="pkp_button submitFormButton" type="submit">
                            Hoàn thành và xác nhận
                        </button>
                        </button>
                        <li><a href="">Gửi bài mới</a></li>
                        <li><a href="">Quay lại </a></li>
                    </ul>
                </form>
                </div>
                
            </div>
        </div>
    </div>
    
    
    
    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
    <script>
        // Hàm hiển thị popup và làm mờ trang
        function showPopup() {
            document.getElementById("overlay").style.display = "block"; // Hiển thị lớp overlay
            document.getElementById("mainBody").classList.add("blur"); // Làm mờ toàn bộ trang
        }
    
        // Hàm đóng popup và khôi phục trang
        function closePopup() {
            document.getElementById("overlay").style.display = "none"; // Ẩn lớp overlay
            document.getElementById("mainBody").classList.remove("blur"); // Bỏ làm mờ toàn bộ trang
        }
    </script>
</body>
</html>