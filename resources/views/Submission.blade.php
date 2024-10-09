<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Gửi bài</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div id="banner"></div>
    
    <div class="layout-shared">
        <nav class="cmp-breadcrumb">
            <ol class="breadcrumb"></ol>
                <li>
                    <a href="/index">Trang chủ</a>
                </li>
                <li>
                <a href="/Submissions">Gửi bài mới</a>
                </li>                    
            </ol>
        </nav>
        @auth
        <div class="alert alert-info" id="loggedin">
            <a href="">Gửi bài</a> hoặc <a href="">xem các bài viết của bạn.</a> đã gửi.
        </div>
    @else
        <!-- Hiển thị khi người dùng chưa đăng nhập -->
        <div class="alert alert-info" id="loggedout">
            <a href="{{ route('login') }}">Đăng nhập</a> hoặc <a href="{{ route('register') }}">Đăng kí</a> để gửi.
        </div>
        <div class="alert alert-info" id="loggedin">
            <a href="">Gửi bài</a> hoặc <a href="">xem các bài viết của bạn.</a> đã gửi.
        </div>
    @endauth
        
        
        <div class="Content">
            <header class="Content-header">
                <h2>Danh sách yêu cầu gửi bài</h2>
            </header>
            <article class="Content-main">
                <p>Là một phần của quá trình gửi, các tác giả được yêu cầu kiểm tra việc tuân thủ tất cả các mục sau của bài nộp của họ và các bài nộp có thể được trả lại cho những tác giả không tuân thủ các nguyên tắc này.</p>
                <div class="Content-text">
                    <ul class="list-group">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Định dạng tài liệu:</strong> Bài viết phải được gửi dưới dạng tệp Microsoft Word (.docx) hoặc PDF (.pdf). Sử dụng font Times New Roman, cỡ chữ 12, khoảng cách dòng 1.5. Tiêu đề bài viết ngắn gọn, súc tích, không quá 15 từ.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Tính nguyên bản:</strong> Bài viết chưa được xuất bản hoặc đang xem xét ở tạp chí khác. Bài viết phải là nghiên cứu mới, không vi phạm bản quyền.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Tóm tắt và từ khóa:</strong> Bài viết phải có tóm tắt (150-250 từ) mô tả nội dung chính và kết luận. Cung cấp 3-5 từ khóa liên quan đến nội dung nghiên cứu.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Hệ thống tham chiếu:</strong> Trích dẫn và tài liệu tham khảo phải tuân thủ theo quy định trích dẫn của tạp chí (APA, MLA, hoặc Chicago). Danh mục tài liệu tham khảo phải đầy đủ và chính xác.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Thông tin tác giả:</strong> Bao gồm tên, cơ quan công tác, địa chỉ email của tất cả các tác giả. Tác giả chính chịu trách nhiệm liên hệ và đảm bảo tính chính xác của thông tin.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Đạo đức nghiên cứu:</strong> Nếu liên quan đến nghiên cứu con người, phải có chấp thuận từ Hội đồng Đạo đức nghiên cứu hoặc tài liệu tương đương.</span>
                            </li>
                        
                            <li class="list-group-item">
                                <span><i class="fa-solid fa-circle-check"></i></span>
                                <span class="item-content"><strong>Phí xuất bản:</strong> Không yêu cầu phí gửi bài, nhưng tác giả phải tuân thủ quy định xuất bản mở và cung cấp tài liệu liên quan nếu cần.</span>
                            </li>
                        </ul>                            
                    </ul>
                </div>
            </article>

            <header class="Content-header">
                <h2>Thể lệ gửi bài</h2>
            </header>
            <article class="Content-main">
                <div class="Content-text">
                    <ol>
                        <li>
                            Tác giả bài báo chịu trách nhiệm trước pháp luật về chất lượng, nội dung, và tính hợp pháp của bài báo. Tác giả cam kết bài báo không có xung đột về lợi ích với các cá nhân, đơn vị, hoặc tổ chức xã hội.
                        </li>
                        <li>
                            Tác giả phải tuân thủ quy định về đăng bài trên Tạp chí, bao gồm việc chỉnh sửa, bổ sung và hoàn thiện bài báo theo yêu cầu của người phản biện và Hội đồng biên tập. Tác giả không được gửi bản thảo bài báo đang gửi cho Tạp chí Khoa học Trường Đại học Kỹ thuật – Công nghệ Cần Thơ đến tạp chí khác khi chưa có quyết định cuối cùng của Tổng biên tập.
                        </li>
                        <li>
                            Tác giả phải trích dẫn rõ ràng và đầy đủ những ý tưởng, kết quả nghiên cứu liên quan đã được công bố và phải chịu trách nhiệm về kết quả nghiên cứu trùng lặp với các công bố khoa học khác.
                        </li>
                        <li>
                            Tác giả có quyền rút lại bản thảo bài báo hoặc điều chỉnh, bổ sung thông tin của bài báo trong vòng 07 ngày kể từ khi gửi bài đến Tạp chí.
                        </li>
                        <li>
                            Tác giả nộp lệ phí đăng bài theo quy định của Trường Đại học Kỹ thuật – Công nghệ Cần Thơ (nếu có).
                        </li>
                    </ol>
                    <p><strong><a href="{{ url('/auth-guidelines') }}">Hướng dẫn tác giả</a></strong></p> 
                    <p><strong><a href="{{ url('/rev-guidelines') }}">Hướng dẫn phản biện</a></strong></p>
                 
                </div>
            </article>

            
        </div>
    </div>
    
    <div id="footer"></div>"
    
    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>