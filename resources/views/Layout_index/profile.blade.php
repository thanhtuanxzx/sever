<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layout</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <style>
        p{
            margin-bottom: 0;
        }
        .full-width {
            grid-column: span 2; /* Phủ kín cả 2 cột */
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
            <img src="img/logo.png" alt="">
            <a href="#" class=""><span style="margin-right: 4px;"><i class="fa-solid fa-box"></i></span>Các bài báo</a>
        </div>
        <div class="pkp_structure_content">
            <div class="pkp_details">
                <div class="pkp_details_profile">
                    <h3>Thông tin cá nhân</h3>
                </div>
            </div>
            <div class="pkp_structure_content">
                <div class="pkpTabs">
                    <div class="tabs-list">
                        <button id="btn-1" class="selected-button" onclick="showContext('1', this); return false;">Thông tin</button>
                        <button id="btn-2" onclick="showContext('2', this); return false;">Liên hệ</button>
                        <button id="btn-3" onclick="showContext('3', this); return false;">Quyền</button>
                        <button id="btn-4" onclick="showContext('4', this); return false;">Hồ sơ cá nhân</button>
                        <button id="btn-5" onclick="showContext('5', this); return false;">Mật khẩu</button>

                    </div>
                
                    <div id="1" class="context active">
                        <div class="pkpListPanel__content">
                        <form method="POST" action="{{ route('user.update1') }}" enctype="multipart/form-data" id="form-1">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="chucDanh" class="form-label"><strong>Chức danh</strong></label>
                                            <select id="chucDanh" class="form-select" name="chucdanh" required>
                                                <option selected>Ông</option>
                                                <option value="1">Bà</option>
                                                <option value="2">Cô</option>
                                                <option value="3">Thạc sĩ</option>
                                                <option value="4">Tiến sĩ</option>
                                                <option value="5">Phó Giáo Sư</option>
                                                <option value="6">Giáo sư</option>
                                            </select>
                                            <small class="form-text text-muted">Chức danh *</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <p><strong>Tài khoản</strong></p>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label"><strong>Họ và tên</strong></label>
                                            <input type="text" class="form-control" id="firstName" name="first_name" placeholder="Chữ đệm và tên" value="{{ Auth::user()->first_name }}" required>
                                            <small class="form-text text-muted">Chữ đệm và tên *</small>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">&nbsp;</label>
                                            <input type="text" class="form-control" id="lastName" name="last_name" placeholder="Họ" value="{{ Auth::user()->last_name }}" required >
                                            <small class="form-text text-muted">Họ *</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="gioiTinh" class="form-label"><strong>Giới tính</strong></label >
                                            <select id="gioiTinh" name ="gioitinh" class="form-select" required>
                                                <option selected>Nam</option>
                                                <option value="1">Nữ</option>
                                                <option value="2">Khác</option>
                                            </select>
                                            <small class="form-text text-muted">Giới tính *</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="displayName" class="form-label"><strong>Bạn thích hiển thị tên như thế nào?</strong></label>
                                            <input type="text" class="form-control" id="displayName" placeholder="Tên hiển thị" value="{{ Auth::user()->username }}">
                                            <small class="form-text text-muted">Tên hiển thị</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12" style="grid-column: span 2;">
                                        <small class="form-text text-muted">Dữ liệu của bạn được lưu trữ theo <a href="#">cam kết bảo mật</a> của chúng tôi.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        <button type="reset" class="btn btn-danger">Hủy bỏ</button>
                                    </div>
                                </div>
                        
                                
                            </form>
                        </div>
                    </div>
                
                    <div id="2" class="context">
                        <div class="pkpListPanel__content">
                        <form method="POST" action="{{ route('user.update2') }}" enctype="multipart/form-data" id="form-2">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <!-- Email -->
                                    <div class="mb-3 full-width">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" name ="" id="email" value="{{ Auth::user()->email }}" readonly>
                                    </div>
                        
                                </div>    
                                
                                <div class="row">
                                    <!-- Organization -->
                                    <div class="mb-3 full-width">
                                    <label for="organization" class="form-label">Đơn vị tổ chức</label>
                                    <textarea class="form-control" id="organization" name="organization" required rows="3" style="max-height: 120px;">{{ Auth::user()->organization }}</textarea>
                                </div>

                                </div>
                        
                                    
                                <div class="row">
                                    <div class="col-12" style="grid-column: span 2;">
                                        <small class="form-text text-muted" name    >Dữ liệu của bạn được lưu trữ theo <a href="#">cam kết bảo mật</a> của chúng tôi.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        <button type="reset" class="btn btn-danger">Hủy bỏ</button>
                                    </div>
                                </div>
                                
                        </form>
                        </div>
                    </div>

                    <div id="3" class="context">
                        <div class="pkpListPanel__content">
                            
                        <form method="POST" action="{{ route('user.update3') }}" enctype="multipart/form-data" id="form-3">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="mb-3 full-width">
                                        <legend class="col-form-label">Quyền</legend>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="reader" required checked>
                                            <label class="form-check-label" for="reader">Đọc giả</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="author" required checked>
                                            <label class="form-check-label" for="author">Tác giả</label>
                                        </div>
                                        
                                        <div class="form-check">
                                        <input type="hidden" name="quyen" value="0">
                                            <input class="form-check-input" type="checkbox" name="quyen" id="reviewer" value="1" {{ Auth::user()->quyen == 1 ? 'checked' : '' }}  >
                                            <label class="form-check-label" for="reviewer">Phản biện</label>
                                        </div>


                                     </div>
                                </div>
                                
                                <div class="row">
                                    <!-- Lĩnh vực nghiên cứu -->
                                    <div class="mb-3 full-width">
                                        <label for="researchField" class="form-label">Lĩnh vực nghiên cứu</label>
                                        <input type="text" class="form-control" id="researchField" name="linhvucnc" placeholder="Nhập lĩnh vực nghiên cứu" value="{{Auth::user()->linhvucnc}}" required>
                                    </div>
                        
                                </div>
                                
                                
                                
                                <div class="row">
                                    <div class="col-12 full-width">
                                        <small class="form-text text-muted">Dữ liệu của bạn được lưu trữ theo <a href="#">cam kết bảo mật</a> của chúng tôi.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        <button type="reset" class="btn btn-danger">Hủy bỏ</button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>

                    <div id="4" class="context">
                        <div class="pkpListPanel__content">
                        <form method="POST" action="{{ route('user.update4') }}" enctype="multipart/form-data" id="form-4">
                            @csrf
                            @method('PUT')
                                <div class="row">
                                    <div class="mb-3 full-width">
                                        <h4><strong>Hình ảnh hồ sơ cá nhân</strong></h4>
                                        <label for="profileImage" class="form-label">Kéo và thả tệp vào đây để bắt đầu tải lên</label>
                                        <input class="form-control" type="file" id="avatar" name="avatar">
                                        
                                        
                                        <div class="mt-2">
                                            <img src="{{ asset( Auth::user()->avatar) }}" alt="Avatar" style="max-width: 150px; max-height: 150px;">
                                            <p>Ảnh đại diện hiện tại.</p>
                                        </div>

                                        
                                    </div>
                                </div>
                                
            
                                <div class="row">
                                    <div class="mb-3 full-width">
                                        <label for="bio" class="form-label">Trình bày tiểu sử (Ví dụ: bộ phận và cấp bậc)</label>
                                        <textarea class="form-control" id="bio" name="tieusu" rows="5" placeholder="Trình bày tiểu sử..." required>{{ Auth::user()->tieusu }}</textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="mb-3 full-width">
                                        <label for="homepageUrl" class="form-label">Trang chủ URL</label>
                                        <input type="url" class="form-control" id="homepageUrl" name="linkurl" placeholder="Nhập URL của bạn" value="{{ Auth::user()->linkurl }}" required>
                                    </div>
                                </div>
            
                                
            
                                <div class="row">
                                    <div class="col-12 full-width">
                                        <small class="form-text text-muted">Dữ liệu của bạn được lưu trữ theo <a href="#">cam kết bảo mật</a> của chúng tôi.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        <button type="reset" class="btn btn-danger">Hủy bỏ</button>
                                    </div>
                                </div>
                            </form>
                                    
                            
                        </div>
                    </div>

                    <div id="5" class="context">
                        <div class="pkpListPanel__content">
                            
                        <form method="POST" action="{{ route('user.update5') }}" enctype="multipart/form-data" id="form-5">
                            @csrf
                            @method('PUT')
                                <div class="row">
        <div class="mb-3 full-width">
            <label for="currentPassword" class="form-label">Mật khẩu hiện tại</label>
            <input type="password" class="form-control" name="current_password" required id="currentPassword" placeholder="Nhập mật khẩu hiện tại">
            @error('current_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 full-width">
            <label for="newPassword" class="form-label">Mật khẩu mới</label>
            <input type="password" class="form-control" name="new_password" required id="newPassword" placeholder="Mật khẩu phải có ít nhất 6 ký tự.">
            @error('new_password')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="mb-3 full-width">
            <label for="confirmPassword" class="form-label">Lặp lại mật khẩu mới</label>
            <input type="password" class="form-control" name="new_password_confirmation" required id="confirmPassword" placeholder="Lặp lại mật khẩu mới">
            @error('new_password_confirmation')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
                                <!-- Xác nhận mật khẩu mới -->
                                
            
                                <div class="row">
                                    <div class="col-12 full-width">
                                        <small class="form-text text-muted">Dữ liệu của bạn được lưu trữ theo <a href="#">cam kết bảo mật</a> của chúng tôi.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" class="btn btn-primary">Lưu lại</button>
                                        <button type="reset" class="btn btn-danger">Hủy bỏ</button>
                                    </div>
                                </div>
                            </form>
                                    
                        </div>
                    </div>
                </div>
        </div>
        
        
    </div>
    
    
    
   
</body>
<script src="{{asset('js/include.js')}}"></script>
<script src="{{asset('JavaScript.js')}}"></script>
</html>