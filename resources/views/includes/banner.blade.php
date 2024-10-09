<div class="Banner">
    <header>
        <img src="{{ asset('img/CTUET.png') }}" alt="Banner">
    </header>
    <div class="Navigation">
        <button class="nav-toggle">&#9776;</button>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ url('/index') }}"><i class="fa fa-home" id="home-icon"></i></a>
            </li>
            <li class="nav-item">
                <div class="nav-link">
                    <a href="#">Giới thiệu</a><i class="fa-solid fa-sort-down"></i>
                </div>
                <div class="nav-item-hidden">
                    <a href="{{ url('/purpose-scope') }}">Mục đích và phạm vi của tạp chí</a>
                    <a href="{{ url('/pub-freq') }}">Tần suất xuất bản</a>
                    <a href="{{ url('/edit-ethics') }}">Biên tập và đạo đức xuất bản</a>
                    <a href="{{ url('/policies-principles') }}">Chính sách chung và các nguyên tắc</a>
                    <a href="{{ url('/sponsorship') }}">Tài trợ tạp chí</a>
                </div>
            </li>
            <li class="nav-item">
                <div class="nav-link">
                    <a href="#">Hướng dẫn</a><i class="fa-solid fa-sort-down"></i>
                </div>
                <div class="nav-item-hidden">
                    <a href="{{ url('/auth-guidelines') }}">Hướng dẫn tác giả</a>
                    <a href="{{ url('/rev-guidelines') }}">Hướng dẫn phản biện</a>
                </div>
            </li>
            <li class="nav-item">
                <a href="{{ url('/edit') }}">Biên tập</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/archiving') }}">Lưu trữ</a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/submission') }}">Gửi bài</a>
            </li>
            @auth
                <li class="nav-item" id="user-menu">
                    <div class="nav-link">
                        <a href="#">{{ $user->username }}<span class="badge">0</span><i class="fa-solid fa-sort-down"></i></a>
                    </div>
                    <div class="nav-item-hidden">
                        <a href="#">Quản lý bài viết <span class="badge">0</span></a>
                        <a href="#">Hồ sơ cá nhân</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-link">Đăng xuất</button>
                        </form>
                    </div>
                </li>
            @else
                <li class="nav-item" id="login-link">
                    <a href="{{ url('/login') }}">Đăng nhập</a>
                </li>
                <li class="nav-item" id="register-link">
                    <a href="{{ url('/register') }}">Đăng ký</a>
                </li>
            @endauth
        </ul>
        <div class="nav-search">
            <input type="text" name="search" placeholder="Tìm kiếm">
            <button type="submit" style="cursor: pointer;"><i class="fa fa-search" aria-hidden="true"></i></button>
        </div>
    </div>
</div>

<script src="{{ asset('js/JavaScript.js') }}"></script>
