<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Ban trị sự</title>
    

</head>
<body>
    
    <div class="container mt-5">
        <h1 class="text-center bg-blue-400 p-4">Thông Tin Phản Biện Viên</h1>

        <!-- Thông tin phản biện viên -->
        <div class="card my-5">
            <div class="card-body">
                <h3>Thông Tin Cá Nhân</h3>
                <p><strong>ID:</strong> 123</p>
                <p><strong>Họ Tên:</strong> Nguyễn Văn A</p>
                <p><strong>Email:</strong> nguyenvana@example.com</p>
            </div>
        </div>

        <!-- Các bài viết đang đảm nhận -->
        <div class="card my-5">
            <div class="card-body">
                <h3 class="text-2xl font-bold">Các Bài Viết Đang Đảm Nhận</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Bài Viết</th>
                            <th>Tiêu Đề</th>
                            <th>Tác Giả</th>
                            <th>Ngày Giao</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BV001</td>
                            <td>Ứng dụng AI trong nông nghiệp</td>
                            <td>Lê Văn B</td>
                            <td>01/09/2024</td>
                        </tr>
                        <tr>
                            <td>BV002</td>
                            <td>Hệ thống quản lý thông tin</td>
                            <td>Trần Thị C</td>
                            <td>05/09/2024</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Các bài viết đã phản biện xong -->
        <div class="card my-5">
            <div class="card-body">
                <h3  class="text-2xl font-bold">Các Bài Viết Đã Phản Biện Xong</h3>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID Bài Viết</th>
                            <th>Tiêu Đề</th>
                            <th>Tác Giả</th>
                            <th>Ngày Hoàn Thành</th>
                            <th>Kết Quả</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>BV003</td>
                            <td>Tối ưu hóa dữ liệu lớn</td>
                            <td>Phạm Quốc D</td>
                            <td>20/08/2024</td>
                            <td class="text-green-400">Chấp Nhận</td>
                        </tr>
                        <tr>
                            <td>BV004</td>
                            <td>Mạng lưới thần kinh nhân tạo</td>
                            <td>Nguyễn Thị E</td>
                            <td>25/08/2024</td>
                            <td class="text-rose-700">Từ Chối</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
  </body>
  </html>