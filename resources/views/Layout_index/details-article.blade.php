<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
    <title>Layout</title>
    <link rel="stylesheet" href="/ass/css/base.css">
    <link rel="stylesheet" href="/ass/css/main.css">
    <link rel="stylesheet" href="/ass/css/index.css">
    <style>
        .hidden {
            display: none;
        }
    </style>
    
</head>
<body>
    <div id="navigationUserWrapper">
    div class="left-group">
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
            
            <nav class="cmp-breadcrumb">
                <ol class="breadcrumb">
                    <li>
                        id bài viết
                    </li>
                    <li>
                        <strong>Tên tác giả</strong>
                    </li>
                    <li>
                        Tiêu đề bài viết
                    </li>                    
                </ol>
            </nav>
            
            <div class="pkpTabs">
                <div class="tabs-list">
                    <button id="btn-1" class="selected-button" onclick="showContext('1', this); return false;">Quy trình</button>
                    <button id="btn-2" onclick="showContext('2', this); return false;">Xuất bản</button>
                </div>
            
                <div id="1" class="context active">
                    <div class="pkpListPanel__content">
                        <div class="tabs-list">
                            <button id="btn-4" class="selected-button" onclick="showContext2('4', this); return false;">Bài nộp</button>
                            <button id="btn-5" onclick="showContext2('5', this); return false;">Phản biện</button>
                            <button id="btn-6" onclick="showContext2('6', this); return false;">Biên tập</button>
                            <button id="btn-7" onclick="showContext2('7', this); return false;">Xuất bản</button>
                        </div>
                        
                        <!-- Nội dung các Tab con -->
                        <div id="4" class="context2 active2">
                            
                            <div class="de-ar-tab-panel-widget">
                                Giai đoạn này chưa được khởi tạo.
                            </div>
                            <div class="de-ar-tab-panel-widget">
                                <div class="de-ar-tab-panel-content">
                                    <div class="de-ar-tab-panel-controller">
                                        <div class="de-ar-panel-controller-header">
                                            <h4>Tệp bài viết</h4>   
                                        </div>
                                        
                                        <span class="de-ar-tab-panel-none-file"><em>Không có tệp</em></span>
                                        <table id="de-ar-table" class="de-ar-tab-panel-controller-table">
                                            <colgroup>
                                                <col style="width: 75%;">
                                                <col style="width: 15%;">
                                                <col style="width: 15%;">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th scope="col" style="text-align: center;"></th>
                                                    <th scope="col" style="text-align: left;"></th>
                                                    <th scope="col" style="float: right;"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="file-table-body">
                                                <tr id="file-row">
                                                    <td>
                                                        <span id="file-info">
                                                            <i class="fa-solid fa-file-word"></i>
                                                            <span>6854-1</span>
                                                            <a href="">Văn bản của bài viết, thanhst84949,<a href="#" id="file-link" title="">eeeee.docx</a></a>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span id="file-date">
                                                            <span>12/09/2024</span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="#" id="edit-file-link" title="Sửa tệp" onclick="showPopup(3)">Chỉnh sửa</a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody id="no-file-message" style="display: none;">
                                                <tr>
                                                    <td colspan="3">Không có tệp</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>

                                    <div class="de-ar-tab-panel-controller">
                                        <div class="de-ar-panel-controller-header">
                                            <h4>Thảo luận trước phản biện</h4>
                                            <h6><a href="#" onclick="showPopup(4)">Tạo cuộc thảo luận</a></h6>
                                        </div>
                                        <table class="de-ar-tab-panel-controller-table">
                                            <colgroup>
                                                <col style="width: 40%;">
                                                <col style="width: 30%;">
                                                <col style="width: 15%;">
                                                <col style="width: 15%;">
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nội dung</th>
                                                    <th scope="col">Tệp</th>
                                                    <th scope="col">Người gửi</th>
                                                    <th scope="col">Thời gian</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span>Nội dung lời nhắn</span>
                                                    </td>
                                                    <td>
                                                        <span><a href=""><i class="fa-solid fa-file-word"></i> File.docs</a></span>
                                                    </td>
                                                    <td>
                                                        <span>Tao nè</span>
                                                    </td>
                                                    <td>
                                                        <span>Ngày tháng năm</span>
                                                        <span>Giờ phút giây</span>
                                                    </td>
                                                    <td>
                                                        <button class="toggle-details-btn" onclick="toggleDetails(this)">
                                                            <i class="fa-solid fa-angle-down toggleIcon"></i>
                                                        </button>
                                                    </td>
                                                    
                                                </tr>

                                                <tr class="details-row hidden">
                                                    <td>
                                                        <strong>Phản hồi của biên tập viên:<br></strong><span>Nội dung</span>
                                                    </td>
                                                    <td>
                                                        <span><a href=""><i class="fa-solid fa-file-word"></i> File.docs</a></span>
                                                    </td>
                                                    <td>
                                                        <span>Biên tập viên</span>
                                                    </td>
                                                    <td>
                                                        <span>Ngày tháng năm</span>
                                                        <span>Giờ phút giây</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tbody id="table-thaoluan">
                                                <!-- Các hàng hiện có sẽ được thêm vào đây -->
                                            </tbody>
                                        </table>
                                        
                                        
                                        
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                        <div id="5" class="context2">
                            <div class="de-ar-tab-panel-widget">
                                Giai đoạn này chưa được khởi tạo.
                            </div>
                            <div class="de-ar-tab-panel-widget">
                                <div class="de-ar-tab-panel-content">
                                    <div class="de-ar-tab-panel-pb-details">
                                        <div class="de-ar-pb-header">
                                            <h4>Danh sách thành phần phản biện</h4>
                                        </div>
                                        <div class="de-ar-pb-member-list">
                                            <!-- Bảng Tác Giả -->
                                            <strong><h6>Tác Giả</h6></strong>
                                            <table class="pb-author-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                    
                                                
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tên tác giả 1</td>
                                                        <td>author1@example.com</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Tên tác giả 2</td>
                                                        <td>author2@example.com</td>
                                                        
                                                    </tr>
                                                    <!-- Thêm các hàng khác ở đây -->
                                                </tbody>
                                            </table>

                                            <!-- Bảng Phản Biện Viên -->
                                            <strong><h6>Phản Biện Viên</h6></strong>
                                            <table class="pb-reviewer-table">
                                                <thead>
                                                    <tr>
                                                        <th>Tên</th>
                                                        <th>Email</th>
                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Tên phản biện viên 1</td>
                                                        <td>reviewer1@example.com</td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>Tên phản biện viên 2</td>
                                                        <td>reviewer2@example.com</td>
                                                        
                                                    </tr>
                                                    <!-- Thêm các hàng khác ở đây -->
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>

                                    <div class="de-ar-tab-panel-pb">
                                        <div class="de-ar-pb-header">
                                            <h4>Khung trò chuyện</h4>
                                        </div>
                                        
                                        <div class="de-ar-pb-content">
                                            <ul class="de-ar-pb-chat" id="chat-list">
                                                <!-- Các tin nhắn sẽ được thêm vào đây -->
                                            </ul>
                                            <div class="de-ar-pb-chat-input">
                                                <textarea id="message-input" placeholder="Nhập nội dung"></textarea>
                                                <label for="file-upload" class="file-label">
                                                    <i class="fa fa-paperclip"></i>
                                                    <input type="file" id="file-upload" style="display: none;">
                                                </label>
                                                <span id="pb-send-message"><i class="fa fa-paper-plane"></i></span>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="6" class="context2">
                            <div class="de-ar-tab-panel-widget">
                                Giai đoạn này chưa được khởi tạo.
                            </div>
                            <div class="de-ar-tab-panel-widget">
                                <div class="de-ar-tab-panel-content">
                                    
                                </div>
                            </div>
                        </div>
                        <div id="7" class="context2">
                            <div class="de-ar-tab-panel-widget">
                                Giai đoạn này chưa được khởi tạo.
                            </div>
                            
                        </div>
                    </div>
                </div>
            
                <div id="2" class="context">
                    <div class="pkpListPanel__content">
                        <div class="tabs-list">
                            <button id="btn-8" onclick="showContext2('8', this); return false;">Tiêu đề & Tóm tắt</button>
                            <button id="btn-9" onclick="showContext2('9', this); return false;">Đồng tác giả</button>
                            <button id="btn-10" onclick="showContext2('10', this); return false;">Tài liệu tham khảo</button>
                        </div>
                        <div class="de-ar-tab-panel-header">
                            <p><strong>Trạng thái: </strong><span>Chưa hoàn thành</span></p>
                        </div>
                        <!-- Nội dung các Tab con -->
                        <div id="8" class="context2">
                            <div class="de-ar-tab-panel-widget">
                                <form class="pkp_ui_content">
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

                                    <div class="section formButtons form_buttons">
                                        <button class="pkp_button submitFormButton" type="submit">
                                            Lưu lại
                                        </button>
                                    </div>
                                </form>
                                
                            </div>
                            
                        </div>


                        <div id="9" class="context2">
                            <div class="de-ar-tab-panel-widget">
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
                                            <col style="width: 15%;">
                                            <col style="width: 30%;">
                                            <col style="width: 10%;">
                                            <col style="width: 3%;">
                                        </colgroup>
                                        <thead>
                                            <tr>
                                                <th scope="col">Tên</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Vai trò</th>
                                                <th style="border: none;"></th>
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
                                
                            </div>
                        </div>
                        <div id="10" class="context2">
                            <div class="de-ar-tab-panel-widget">
                                <div class="pkp_ui_textfill_div"> 
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
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        
    </div>

    <!-- Thêm tác giả -->
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
                    <label for="option2">Phản biện</label><br>
                </div>
                <button type="submit" class="submit-btn">Xác nhận thêm tác giả</button>
            </form>
            <button onclick="closePopup(1)">Đóng</button>
        </div>
    </div>
    <!-- Tài liệu tham khảo  -->
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
    <!-- Chỉnh sữa tệp  -->
    <!-- Popup cho chỉnh sửa tệp -->
    <div class="overlay" id="overlay3">
        <div class="popup">
            <h3>Chỉnh sửa tệp</h3>
            <form id="de-ar-edit-file-form">
                <div>
                    <label for="de-ar-new-file">Chọn tệp mới:</label>
                    <input type="file" id="de-ar-new-file" name="de-ar-new-file" accept=".doc,.docx,.pdf">
                </div>
                <div>
                    <label for="de-ar-new-filename">Tên tệp mới:</label>
                    <input type="text" id="de-ar-new-filename" name="de-ar-new-filename" value="eeeee.docx">
                </div>
                <button type="button" onclick="saveChangesfilede_ar()">Lưu thay đổi</button>
                <button type="button" onclick="closePopup(3)">Đóng</button>
            </form>
        </div>
    </div>
    <!-- Thảo luận trước vòng phản biện -->
    <div class="overlay" id="overlay4">
        <div class="popup">
            <h3>Thêm nội dung mới</h3>
            <form id="add-message-form">
                <div>
                    <label for="message-content">Nội dung lời nhắn:</label>
                    <textarea id="message-content" name="message-content" rows="4" required></textarea>
                </div>
                <div>
                    <label for="file-upload">Chọn tệp:</label>
                    <input type="file" id="file-upload" name="file-upload" accept=".doc,.docx,.pdf" required>
                </div>
                <button type="button" onclick="addData()">Thêm dữ liệu</button>
                <button type="button" onclick="closePopup(4)">Đóng</button>
            </form>
        </div>
    </div>

    
    
    <script>

        // Hàm thảo luận trc vòng phản biện overplay 4
        // Biến chứa tên người gửi
        var acccauthor = "Tác giả";

        // Hàm thêm dữ liệu mới vào bảng
        function addData() {
            var content = document.getElementById('message-content').value;
            var fileInput = document.getElementById('file-upload');

            // Kiểm tra xem có nội dung và tệp không
            if (content && fileInput.files.length > 0) {
                var file = fileInput.files[0];
                var filename = file.name;

                // Tạo một hàng mới trong bảng
                var tableBody = document.getElementById('table-thaoluan');
                var newRow = document.createElement('tr');

                newRow.innerHTML = `
                    <td><span>${content}</span></td>
                    <td><span><a href="${URL.createObjectURL(file)}"><i class="fa-solid fa-file-word"></i> ${filename}</a></span></td>
                    <td><span>${acccauthor}</span></td>
                    <td>
                        <span>${getCurrentDate()}</span>
                        <span>${getCurrentTime()}</span>
                    </td>
                    <td>
                        <button class="toggle-details-btn" onclick="toggleDetails(this)">
                            <i class="fa-solid fa-angle-down toggleIcon"></i>
                        </button>
                    </td>
                `;

                // Thêm hàng chi tiết không thay đổi vào bảng
                var detailRow = document.createElement('tr');
                detailRow.className = 'details-row hidden';
                detailRow.innerHTML = `
                    <td>
                        <strong>Phản hồi của biên tập viên:<br></strong><span>Nội dung</span>
                    </td>
                    <td>
                        <span><a href=""><i class="fa-solid fa-file-word"></i> File.docs</a></span>
                    </td>
                    <td>
                        <span>Biên tập viên</span>
                    </td>
                    <td>
                        <span>date</span>
                        <span>time</span>
                    </td>
                `;

                // Thêm hàng mới và hàng chi tiết vào bảng
                tableBody.appendChild(newRow);
                tableBody.appendChild(detailRow);

                // Đóng popup sau khi thêm dữ liệu
                closePopup(4);
            } else {
                alert("Vui lòng điền đầy đủ thông tin và chọn tệp!");
            }
        }

        

        

        // Hàm để chuyển đổi hiển thị chi tiết
        function toggleDetails(button) {
            var detailsRow = button.closest('tr').nextElementSibling;
            if (detailsRow && detailsRow.classList.contains('details-row')) {
                detailsRow.classList.toggle('hidden');
                button.querySelector('.toggleIcon').classList.toggle('fa-angle-down');
                button.querySelector('.toggleIcon').classList.toggle('fa-angle-up');
            }
        }




        // Hàm tin nhắn ID=5 Phản biện
        // Lấy các phần tử cần thiết từ DOM
        const messageInput = document.getElementById("message-input");
        const fileUpload = document.getElementById("file-upload");
        const sendMessageBtn = document.getElementById("pb-send-message");
        const chatList = document.getElementById("chat-list");

        // Hàm để tạo ra tin nhắn
        function createMessage(content, fileName = null, fileObject = null, isOutgoing = true) {
            const li = document.createElement("li");
            li.className = isOutgoing ? "pb-chat-outgoing" : "pb-chat-incoming";

            // Thêm tên người gửi
            const senderLabel = document.createElement("label");
            senderLabel.className = "pb-chat-pb-name-acc";
            senderLabel.innerHTML = `<strong>${isOutgoing ? "Bạn"/* biến tên account*/ : "Người gửi"}</strong>`;
            li.appendChild(senderLabel);

            // Thêm nội dung tin nhắn
            const messageP = document.createElement("p");
            messageP.className = "pb-chat-content-massege";
            messageP.textContent = content;
            li.appendChild(messageP);

            // Nếu có file đính kèm
            if (fileName && fileObject) {
                const fileLink = document.createElement("a");
                fileLink.className = "pb-chat-massege-file";
                
                // Thêm biểu tượng file Word trước tên file
                fileLink.innerHTML = `<i class="fa-regular fa-file"></i> ${fileName}`;

                // Tạo URL từ đối tượng file
                const fileURL = URL.createObjectURL(fileObject);
                fileLink.href = fileURL;
                fileLink.download = fileName;  // Cho phép tải file khi nhấp vào link

                li.appendChild(fileLink);
            }

            // Thêm ngày tháng và thời gian gửi tin nhắn
            const timeDateP = document.createElement("p");
            timeDateP.className = "pb-chat-massege-time";
            const dateString = getCurrentDate();
            const timeString = getCurrentTime();
            timeDateP.textContent = `${dateString} - ${timeString}`;
            li.appendChild(timeDateP);

            return li;
        }

        // Xử lý sự kiện gửi tin nhắn
        sendMessageBtn.addEventListener("click", function() {
            const messageContent = messageInput.value.trim();
            const fileObject = fileUpload.files.length ? fileUpload.files[0] : null;
            const fileName = fileObject ? fileObject.name : null;

            if (messageContent || fileObject) {
                // Tạo tin nhắn mới
                const newMessage = createMessage(messageContent, fileName, fileObject, true);

                // Thêm tin nhắn vào danh sách
                chatList.appendChild(newMessage);

                // Cuộn xuống cuối khung chat
                chatList.scrollTop = chatList.scrollHeight;

                // Xóa nội dung nhập và file sau khi gửi
                messageInput.value = "";
                fileUpload.value = "";
            } else {
                alert("Vui lòng nhập tin nhắn hoặc chọn file để gửi.");
            }
        });


    </script>
<script src="{{asset('js/include.js')}}"></script>
<script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>