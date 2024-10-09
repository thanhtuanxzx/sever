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
                    <button onclick="showContext('step1'); return false;">Bắt đầu</button>
                    <button onclick="showContext('step2'); return false;">Tải lên bài nộp</button>
                    <button onclick="showContext('step3'); return false;">Nhập dữ liệu</button>
                    <button onclick="showContext('step4'); return false;">Xác nhận</button>
                    <button onclick="showContext('step5'); return false;">Lưu trữ</button>
                </div>

                <div id="step1" class="context">
                    <form class="pkp_ui_content" action="{{ route('bai_viet.store') }}" method="POST">
                        @csrf
                        <h5>Chuyên mục</h5>
                        <select class="pkp_ui_select" name="chu_de">
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

                        <h5>Yêu cầu của bài nộp</h5>
                        <p>Bạn phải đọc và xác nhận rằng bạn đã hoàn thành các yêu cầu bên dưới trước khi tiếp tục.</p>
                        <ul class="checkbox_and_radiobutton">
                            <li>
                                <label>
                                    <input type="checkbox" id="checklist-0" required="1" value="1" validation="required"
                                        name="checklist[]" class="field checkbox required" aria-required="true">
                                    Bài gửi chưa được xuất bản trước đó, hoặc đang gửi cho một tạp chí khác xem xét
                                    (hoặc một lời giải thích đã được cung cấp trong Nhận xét cho Biên tập viên).
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" id="checklist-1" required="1" value="1" validation="required"
                                        name="checklist[]" class="field checkbox required" aria-required="true">
                                    Tập tin bài gửi ở định dạng tệp tài liệu OpenOffice, Microsoft Word hoặc RTF.
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" id="checklist-3" required="1" value="1" validation="required"
                                        name="checklist[]" class="field checkbox required" aria-required="true">
                                    Các văn bản là khoảng cách đơn; sử dụng phông chữ 12; sử dụng chữ nghiêng, thay vì
                                    gạch chân (trừ địa chỉ URL); và tất cả các hình minh họa, số liệu và bảng được đặt
                                    trong văn bản tại các điểm thích hợp, thay vì ở cuối bản thảo.
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" id="checklist-4" required="1" value="1" validation="required"
                                        name="checklist[]" class="field checkbox required" aria-required="true">
                                    Văn bản tuân thủ các yêu cầu về trình bày văn bản và tài liệu tham khảo được nêu
                                    trong Hướng dẫn cho tác giả.
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox" id="checklist-5" required="1" value="1" validation="required"
                                        name="checklist[]" class="field checkbox required" aria-required="true">
                                    Tác giả liên hệ gửi bài phải nhập đầy đủ thông tin của bài viết vào các trường dữ
                                    liệu tương ứng theo 2 ngôn ngữ tiếng Việt và tiếng Anh (Danh sách tác giả khi khai
                                    báo phải giống thứ tự tác giả trong tập tin).
                                </label>
                            </li>
                        </ul>

                        <h5>Ghi chú cho biên tập viên</h5>
                        <input type="text" name="ghichu" required>

                        <ul class="checkbox_and_radiobutton" style="list-style-type: none;">
                            <li>
                                <label>
                                    <input type="checkbox" id="privacyConsent" required="1" value="1"
                                        validation="required" name="privacyConsent" class="field checkbox required"
                                        checked="checked" aria-required="true">
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
    <form class="pkp_ui_content" action="{{ route('bai_viet.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <h5>Tải tập tin</h5>
            <div>
                <label for="file">Tập tin:</label>
                <input type="file" name="file" id="file" required>
            </div>
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
</div>



            <div id="step3" class="context active">
                <form class="pkp_ui_content">
                    <h5>Tiêu đề</h5>
                    <input type="text" name="tieu_de" id="" required>

                    <h5>Tóm tắt</h5>
                    <p>Phần tóm tắt phải có 250 từ trở xuống.</p>
                    <input type="text" name="" id="" required>

                    <h5>Từ khóa</h5>
                    <p>Thêm thông tin bổ sung cho bài nộp của bạn. Nhấn 'enter' sau mỗi thuật ngữ.</p>
                    <input type="text" required>

                    <div>
                        <div class="header">
                            <h4>Danh sách Đồng Tác Giả</h4>
                            <ul>
                                <li>
                                    <a href="#" title="Thêm tác giả" onclick="themDongTacGia(event)">Thêm đồng tác
                                        giả</a>
                                </li>
                            </ul>
                        </div>


                        <table id="danhSachDongTacGia">
                            <colgroup>
                                <col style="width: 15%;">
                                <col style="width: 15%;">
                                <col style="width: 20%;">
                                <col style="width: 15%;">
                                <col style="width: 10%;">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th scope="col">Tên</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Tổ chức</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Vai trò</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authors as $author)
                                    <tr>
                                        <td>
                                            <span>{{ $author->first_name }} {{ $author->last_name }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $author->email }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $author->organization }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $author->phone }}</span>
                                        </td>
                                        <td>
                                            <span>{{ $author->reviewer ? 'Reviewer' : 'Tác giả' }}</span>
                                            <!-- Hiển thị vai trò từ cơ sở dữ liệu -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>


                    <div class="pkp_ui_references">
                        <h1>Thêm trích dẫn mới</h1>
                        <form action="{{ route('citations.store_multiple') }}" method="POST">
                            @csrf
                            <div id="citations-container">
                                <div class="form-group citation-item">
                                    <label for="title[]">Tiêu đề</label>
                                    <input type="text" name="title[]" class="form-control" required>
                                    <label for="link[]">Liên kết</label>
                                    <input type="url" name="link[]" class="form-control" required>
                                    <button type="button" class="btn btn-danger remove-citation">Xóa</button>
                                </div>
                            </div>
                            <button type="button" id="add-citation" class="btn btn-secondary">Thêm trích
                                dẫn</button>
                            <button type="submit" class="btn btn-primary">Lưu</button>

                        </form>
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
            </div>

            <div id="step4" class="context">
                <form class="pkp_ui_content">
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
                <form class="pkp_ui_content">
                    <h5>Hoàn thành việc gửi bài</h5>
                    <p>Cảm ơn bạn đã nộp bài vào Tạp chí Khoa học Đại học Kỹ thuật - Công nghệ Cần Thơ.</p>

                    <span></span>

                    <p>Ban biên tập đã nhận được thông báo về bài nộp của bạn và bạn cũng đã được gửi email xác nhận
                        cho bài nộp của mình. Khi ban biên tập xem xét nội dung bài nộp, họ sẽ liên hệ với bạn sau.
                    </p>

                    <ul>
                        <li><a href="">Xem lại bài nộp</a></li>
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
</body>



</html>