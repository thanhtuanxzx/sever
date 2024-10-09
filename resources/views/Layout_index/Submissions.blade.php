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
            <img src="/ass/img/logo.png" alt="">
            <a href="#" class=""><span style="margin-right: 4px;"><i class="fa-solid fa-box"></i></span>Các bài báo</a>
        </div>
    
        <div class="pkp_structure_content">
            <div class="pkp_page_title">
                <h3>Các bài báo</h3>
            </div>
            <div class="pkpTabs">
                <div class="tabs-list">
                    <button onclick="showContext('1'); return false;">Hàng chờ</button>
                    <button onclick="showContext('2'); return false;">Lưu trữ</button>
                </div>

                <div id="1" class="context active">
                    <div class="tabs-nav">
                        <div class="left-group">
                            <h4>Được giao cho tôi</h4>
                        </div>
                        <div class="right-group">
                            <div class="nav-search">
                                <input type="text" name="search" placeholder="Tìm kiếm">
                                <button type="submit" style="cursor: pointer;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <a href="wizard/step1"><button class="tabs-nav-button">Gửi bài mới</button></a>
                            
                        </div>                     
                    </div>
                    <div class="pkpListPanel__content">
                        <div class="pkpListPanel__empty"> Không tìm thấy bài báo nào. </div>
                        <div class="pkpListPanelItem_summary">



                        @foreach ($baiVietList as $baiViet)
                        <div class="pkpListPanel_Item">
                            <a href="">
                                <div class="pkpPanel_Item_Detail">
                                    <span class="pkpPanel_Item_Detail_span">
                                        <strong>{{ $baiViet->id_bai_viet }}</strong>
                                    </span>
                                    <div class="pkpPanel_Item_Detail_nameheading">
                                        <span><p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p></span>
                                        <span><p>{{ $baiViet->tieu_de }}</p></span>
                                    </div>
                                </div>
                            </a>
                            <div class="pkpListPanelItem_status">
                                <div class="pkpListPanel_Item_Bage">
                                    {{ $baiViet->trang_thai }}
                                </div>
                                <span style="margin-top: 10px; margin: 25px;">
                                    <i class="fa-solid fa-comment"></i><span> 2</span>
                                </span>
                            </div>

                            <button class="pkpListPanelItem__expander" onclick="toggleDetails(this)">
                                <span aria-hidden="true" class="fa fa-angle-down toggleIcon"></span>
                            </button>

                            <div class="details hidden">
                                <div class="pkpListPanelItem_haslabel">
                                    <span><i class="fa-solid fa-comment"></i><span> 2</span></span>
                                    <label for="text">
                                        <span> || </span>Hoạt động cuối cùng được ghi lại vào {{ \Carbon\Carbon::parse($baiViet->updated_at)->format('d/m/Y') }}
                                    </label>
                                </div>
                                <button class="pkpListPanelItem_button">Xem chi tiết</button>
                            </div>
                        </div>
                        @endforeach









                            
                        </div>
                    </div>
                    
                </div>
                


                <div id="2" class="context">
                    <div class="tabs-nav" >
                        <h4>Bài nộp được lưu trữ</h4>
                        <div class="right-group">
                            <div class="nav-search">
                                <input type="text" name="search" placeholder="Tìm kiếm">
                                <button type="submit" style="cursor: pointer;"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </div>
                            <a href="wizard"><button class="tabs-nav-button">Gửi bài mới</button></a>
                            
                        </div> 
                    </div>
                    <div class="pkpListPanel__content">
                        <div class="pkpListPanel__empty"> Không tìm thấy bài báo nào. </div>
                        <div class="pkpListPanelItem_summary">

                        @foreach ($baiVietList as $baiViet)
                        <!-- @dump($wizardProgress)  -->

                        @if ($wizardProgress->contains(fn($progress) => $progress->current_step == 5 && $progress->bai_viet_id == $baiViet->id_bai_viet))
                            <div class="pkpListPanel_Item">
                                <a href="">
                                    <div class="pkpPanel_Item_Detail">
                                        <span class="pkpPanel_Item_Detail_span">
                                            <strong>{{ $baiViet->id_bai_viet }}</strong>
                                        </span>
                                        <div class="pkpPanel_Item_Detail_nameheading">
                                            <span>
                                                <p>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</p>
                                            </span>
                                            <span>
                                                <p>{{ $baiViet->tieu_de }}</p>
                                            </span>
                                        </div>
                                    </div>
                                </a>
                                <div class="pkpListPanelItem_status">
                                    <div class="pkpListPanel_Item_Bage">
                                        {{ $baiViet->trang_thai }}
                                    </div>
                                    <span style="margin-top: 10px; margin: 25px;">
                                        <i class="fa-solid fa-comment"></i><span> 2</span>
                                    </span>
                                </div>

                                <button class="pkpListPanelItem__expander" onclick="toggleDetails(this)">
                                    <span aria-hidden="true" class="fa fa-angle-down toggleIcon"></span>
                                </button>

                                <div class="details hidden">
                                    <div class="pkpListPanelItem_haslabel">
                                        <span><i class="fa-solid fa-comment"></i><span> 2</span></span>
                                        <label for="text">
                                            <span> || </span>Hoạt động cuối cùng được ghi lại vào {{ \Carbon\Carbon::parse($baiViet->updated_at)->format('d/m/Y') }}
                                        </label>
                                    </div>
                                    <button class="pkpListPanelItem_button">Xem chi tiết</button>
                                </div>
                            </div>
                        @endif
                    @endforeach



                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>



    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>

</html>