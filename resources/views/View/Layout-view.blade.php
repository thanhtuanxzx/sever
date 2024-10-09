<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Views</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
    <div id="banner"></div>
    
    <div class="layout-shared">
        <nav class="cmp-breadcrumb">
            <ol class="breadcrumb">
                <li>
                    <a href="/sever_api/resources/views/index.blade.php">Trang chủ</a>
                </li>
                <li>
                    <a href="/sever_api/resources/views/Archiving.blade.php">Lưu trữ</a>
                </li>
                <li>
                    Tập. 1 Số. 1 (2024)
                </li>                    
            </ol>
        </nav>
        <div class="content">
            <div class="issue">
                <div class="issue-heading">
                    <div class="thumbnail">
                        <a class="cover" href="">
                            <img class="issue-img" src="/sever_api/resources/img/thobaymau.jpg" alt="">
                        </a>
                    </div>
                    <div class="thumbnail-detai"></div>
                        <p class="published">
                            <strong>
                                Ngày xuất bản:
                            </strong>
                            01/01/2000
                        </p>
                        <div class="galleys-section">
                            <div class="galleys-group">
                                <a class="galley-link btn btn-borders btn-xs btn-outline pdf" role="button" href=""><i class="far fa-file-pdf"></i> Tập. 1 Số. 1 (2024)</a>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <div class="issue-sections">
                    <section class="section">
                        <h2>
                            <small>Khoa học Công nghệ thông tin</small>
                        </h2>
                        <div class="media-list">
                            <div class="media-body">
                                <div class="col-md-12 pl-0">
                                    <a class="article-title" href="https://dthujs.vn/index.php/dthujs/article/view/1594">
                                        <span>Thực trạng quản lý hoạt động giáo dục địa phương cho học sinh ở các trường tiểu học huyện Tam Nông, tỉnh Đồng Tháp</span>
                                    </a>
                                    <div class="meta">
                                        <div class="authors pb-0">
                                            Trần Đại Nghĩa, Nguyễn Ngọc Thiên Trung
                                        </div>
                                    </div>
                                    <div class="doi">
                                        <a href="https://doi.org/10.52714/dthu.13.01S.2024.1281">
                                            https://doi.org/10.52714/dthu.13.01S.2024.1281
                                        </a>
                                    </div>
                                    <div role="group" class="d-inline-block pt-3">
                                        <a class="galley-link btn btn-borders btn-xs btn-outline pdf" role="button" href="https://dthujs.vn/index.php/dthujs/article/view/1594/1393">
                                            <i class="far fa-file-pdf"></i> PDF
                                        </a>
                                        <a class="galley-link btn btn-borders btn-xs btn-outline" role="button" data-toggle="modal" data-target="#vojsCitation-1594">
                                            <i class="fas fa-quote-right fa-xs"></i> Trích dẫn
                                        </a>
                                        <div class="modal fade" id="vojsCitation-1594" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="panel panel-default how-to-cite modal-content">
                                                    <div class="modal-header panel-heading">
                                                        <h4>Cách trích dẫn</h4>
                                                    </div>
                                                    <div class="modal-body panel-body">
                                                        <div id="citationOutput-1594" role="region" aria-live="polite">
                                                            <div class="csl-bib-body">
                                                                <div class="csl-entry">Trần, Đ. N., & Nguyễn, N. T. T. (2024). Thực trạng quản lý hoạt động giáo dục địa phương cho học sinh ở các trường tiểu học huyện Tam Nông, tỉnh Đồng Tháp. <i>Tạp chí Khoa học Đại học Đồng Tháp</i>, <i>13</i>(01S), 1-10. https://doi.org/10.52714/dthu.13.01S.2024.1281</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                Thêm định dạng trích dẫn
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <!-- Các tùy chọn trích dẫn khác -->
                                                                <li><a href="https://dthujs.vn/index.php/dthujs/citationstylelanguage/get/apa?submissionId=1594&publicationId=1594">APA</a></li>
                                                                <li><a href="https://dthujs.vn/index.php/dthujs/citationstylelanguage/get/chicago-author-date?submissionId=1594&publicationId=1594">Chicago</a></li>
                                                                <li><a href="https://dthujs.vn/index.php/dthujs/citationstylelanguage/get/ieee?submissionId=1594&publicationId=1594">IEEE</a></li>
                                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary mb-0 ml-5" id="copyBtn-1594">
                                                            <span class="icon-copy-btn fas fa-copy"></span> Sao chép
                                                        </button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-borders btn-xs btn-outline float-right pointer-events-none">Trang: 1-10</a>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="col-md-12 pl-0">
                                    <a class="article-title">
                                        <span>Ứng dụng trí tuệ nhân tạo trong việc tối ưu hóa hệ thống quản lý dữ liệu tại Khoa Công nghệ Thông tin, Trường Đại học Kỹ thuật - Công nghệ Cần Thơ</span>
                                    </a>
                                    <div class="meta">
                                        <div class="authors pb-0">
                                            Nguyễn Văn A, Trần Thị B
                                        </div>
                                    </div>
                                    <div class="doi">
                                        <a>Không có DOI cho bài viết này</a>
                                    </div>
                                    <div role="group" class="d-inline-block pt-3">
                                        <a class="galley-link btn btn-borders btn-xs btn-outline pdf" role="button">
                                            <i class="far fa-file-pdf"></i> PDF
                                        </a>
                                        <a class="galley-link btn btn-borders btn-xs btn-outline" role="button" data-toggle="modal" data-target="#vojsCitation-1594">
                                            <i class="fas fa-quote-right fa-xs"></i> Trích dẫn
                                        </a>
                                        <div class="modal fade" id="vojsCitation-1594" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="panel panel-default how-to-cite modal-content">
                                                    <div class="modal-header panel-heading">
                                                        <h4>Cách trích dẫn</h4>
                                                    </div>
                                                    <div class="modal-body panel-body">
                                                        <div id="citationOutput-1594" role="region" aria-live="polite">
                                                            <div class="csl-bib-body">
                                                                <div class="csl-entry">Nguyễn, V. A., & Trần, T. B. (2024). Ứng dụng trí tuệ nhân tạo trong việc tối ưu hóa hệ thống quản lý dữ liệu tại Khoa Công nghệ Thông tin, Trường Đại học Kỹ thuật - Công nghệ Cần Thơ. <i>Tạp chí Khoa học Công nghệ Thông tin</i>, <i>13</i>(01S), 1-10.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                Thêm định dạng trích dẫn
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <!-- Các tùy chọn trích dẫn khác -->
                                                                <li><a>APA</a></li>
                                                                <li><a>Chicago</a></li>
                                                                <li><a>IEEE</a></li>
                                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary mb-0 ml-5" id="copyBtn-1594">
                                                            <span class="icon-copy-btn fas fa-copy"></span> Sao chép
                                                        </button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-borders btn-xs btn-outline float-right pointer-events-none">Trang: 1-10</a>
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="col-md-12 pl-0">
                                    <a class="article-title">
                                        <span>Ứng dụng trí tuệ nhân tạo trong việc tối ưu hóa hệ thống quản lý dữ liệu tại Khoa Công nghệ Thông tin, Trường Đại học Kỹ thuật - Công nghệ Cần Thơ</span>
                                    </a>
                                    <div class="meta">
                                        <div class="authors pb-0">
                                            Nguyễn Văn A, Trần Thị B
                                        </div>
                                    </div>
                                    <div class="doi">
                                        <a>Không có DOI cho bài viết này</a>
                                    </div>
                                    <div role="group" class="d-inline-block pt-3">
                                        <a class="galley-link btn btn-borders btn-xs btn-outline pdf" role="button">
                                            <i class="far fa-file-pdf"></i> PDF
                                        </a>
                                        <a class="galley-link btn btn-borders btn-xs btn-outline" role="button" data-toggle="modal" data-target="#vojsCitation-1594">
                                            <i class="fas fa-quote-right fa-xs"></i> Trích dẫn
                                        </a>
                                        <div class="modal fade" id="vojsCitation-1594" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="panel panel-default how-to-cite modal-content">
                                                    <div class="modal-header panel-heading">
                                                        <h4>Cách trích dẫn</h4>
                                                    </div>
                                                    <div class="modal-body panel-body">
                                                        <div id="citationOutput-1594" role="region" aria-live="polite">
                                                            <div class="csl-bib-body">
                                                                <div class="csl-entry">Nguyễn, V. A., & Trần, T. B. (2024). Ứng dụng trí tuệ nhân tạo trong việc tối ưu hóa hệ thống quản lý dữ liệu tại Khoa Công nghệ Thông tin, Trường Đại học Kỹ thuật - Công nghệ Cần Thơ. <i>Tạp chí Khoa học Công nghệ Thông tin</i>, <i>13</i>(01S), 1-10.</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="btn-group">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                                                Thêm định dạng trích dẫn
                                                                <span class="caret"></span>
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <!-- Các tùy chọn trích dẫn khác -->
                                                                <li><a>APA</a></li>
                                                                <li><a>Chicago</a></li>
                                                                <li><a>IEEE</a></li>
                                                                <!-- Thêm các tùy chọn khác nếu cần -->
                                                            </ul>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary mb-0 ml-5" id="copyBtn-1594">
                                                            <span class="icon-copy-btn fas fa-copy"></span> Sao chép
                                                        </button>
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <a class="btn btn-borders btn-xs btn-outline float-right pointer-events-none">Trang: 1-10</a>
                                </div>
                            </div>
                            
                        </div>
                    </section>
                </div>
            </div>
        </div>
        
    </div>
    
    <div id="footer"></div>
    
    <script src="{{asset('js/include.js')}}"></script>
    <script src="{{asset('JavaScript.js')}}"></script>
</body>
</html>