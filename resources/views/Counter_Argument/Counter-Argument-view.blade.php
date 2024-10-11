<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Phản biện bài viết</title>

    

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow Co-Ar-navbar">
      <div class="container-fluid">
        <a class="navbar-brand Co-Ar-brand" href="#">Phản Biện Viên</a>
      </div>
    </nav>
  
    <!-- Tabs cho nội dung -->
    <div class="container mt-5 Co-Ar-container">
      <!-- Tab Titles -->
      <ul class="nav nav-tabs Co-Ar-nav-tabs" id="Co-Ar-tabContent">
        <li class="nav-item">
          <a class="nav-link active Co-Ar-tab-link" id="Co-Ar-tab1" data-bs-toggle="tab" href="#Co-Ar-worklist">Công Việc Phụ Trách</a>
        </li>
        <li class="nav-item">
          <a class="nav-link Co-Ar-tab-link" id="Co-Ar-tab2" data-bs-toggle="tab" href="#Co-Ar-notifications">Thông Báo</a>
        </li>
      </ul>
  
      <!-- Tab Content -->
      <div class="tab-content mt-3 Co-Ar-tab-content">
        
        <!-- Danh Sách Công Việc Phụ Trách -->
        <div class="tab-pane fade show active Co-Ar-pane" id="Co-Ar-worklist">
          <h2 class="text-xl font-bold mb-4 Co-Ar-title">Danh Sách Công Việc Phụ Trách</h2>
          <table class="table table-striped table-bordered Co-Ar-table">
            <thead class="Co-Ar-thead">
              <tr>
                <th class="Co-Ar-th">ID Bài Viết</th>
                <th class="Co-Ar-th">Tên Bài Viết</th>
                <th class="Co-Ar-th">Ngày Giao</th>
                <th class="Co-Ar-th">Trạng Thái</th>
                <th class="Co-Ar-th">Chi Tiết</th>
              </tr>
            </thead>
            <tbody class="Co-Ar-tbody">
              <tr>
                <td class="Co-Ar-td">001</td>
                <td class="Co-Ar-td">Ứng dụng AI trong Y Tế</td>
                <td class="Co-Ar-td">2024-09-15</td>
                <td class="Co-Ar-td">Đang xử lý</td>
                <td class="Co-Ar-td"><a href="/Counter- Argument/Counter- Argument-Detail.html" class="btn btn-primary Co-Ar-btn">Xem Chi Tiết</a></td>
              </tr>
            </tbody>
          </table>
        </div>
  
        <!-- Thông Báo -->
        <div class="tab-pane fade Co-Ar-pane" id="Co-Ar-notifications">
          <h2 class="text-xl font-bold mb-4 Co-Ar-title">Thông Báo</h2>
          <div class="Co-Ar-notification-list">
            <div class="border rounded p-4 mb-4 shadow-sm Co-Ar-notification-item">
              <h4 class="font-bold mb-2 Co-Ar-notification-title">Yêu cầu phản biện bài viết "Ứng dụng AI trong Nông nghiệp"</h4>
              <p class="mb-2 Co-Ar-notification-message">
                Bạn đã được mời phản biện cho bài viết <strong>"Ứng dụng AI trong Nông nghiệp"</strong>. Bạn có muốn chấp nhận phản biện bài viết này không?
              </p>
              <div class="flex space-x-4">
                <button class="btn btn-success Co-Ar-btn-accept">Chấp Nhận</button>
                <button class="btn btn-danger Co-Ar-btn-reject">Từ Chối</button>
              </div>
            </div>
            <div class="border rounded p-4 mb-4 shadow-sm Co-Ar-notification-item">
              <h4 class="font-bold mb-2 Co-Ar-notification-title">Yêu cầu phản biện bài viết "Blockchain và Quản lý dữ liệu"</h4>
              <p class="mb-2 Co-Ar-notification-message">
                Bạn đã được mời phản biện cho bài viết <strong>"Blockchain và Quản lý dữ liệu"</strong>. Bạn có muốn chấp nhận phản biện bài viết này không?
              </p>
              <div class="flex space-x-4">
                <button class="btn btn-success Co-Ar-btn-accept">Chấp Nhận</button>
                <button class="btn btn-danger Co-Ar-btn-reject">Từ Chối</button>
              </div>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>