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
                    <a href="/wizard/step1"><button >Bắt đầu</button></a>
                    <a href="/wizard/step2"><button >Tải lên bài nộp</button></a>
                    <a href="/wizard/step3"><button >Nhập dữ liệu</button></a>
                    <a href="/wizard/step4"><button >Xác nhận</button></a>
                    <a href="/wizard/step5"><button >Lưu trữ</button></a>
                </div>

               

            
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
                    <button class="pkp_button submitFormButton" type="submit" value="continue">
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