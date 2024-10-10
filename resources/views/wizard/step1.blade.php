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
                        <a href="/login">Đăng nhập</a>
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
                        <button class="pkp_button submitFormButton" type="submit" value="continue">
                            Lưu và tiếp tục
                        </button>
                    </div>
                </form>


            </div>
        </div>
    </div>

    <script>
        let isFormSubmitted = false; // Biến kiểm tra nếu form đã submit

        // Khi nút submit được nhấn
        document.querySelector('.submitFormButton').addEventListener('click', function(event) {
            if (this.value === 'continue') {
                
                isFormSubmitted = true;
                window.removeEventListener('beforeunload', warnUser); // Xóa sự kiện beforeunload
            }
        });

        // Hàm cảnh báo trước khi thoát trang
        function warnUser(e) {
            // Nếu form chưa submit, hiển thị cảnh báo thoát trang
            if (!isFormSubmitted) {
                e.preventDefault();
                e.returnValue = ''; // Hiển thị cảnh báo thoát trang
            }
        }

        // Gắn sự kiện trước khi thoát trang
        window.addEventListener('beforeunload', warnUser);

    </script>

    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>



</html>