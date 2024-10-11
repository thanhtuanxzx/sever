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
    
  <!-- Header -->
  <header class="bg-blue-400 p-4 text-white">
    <h1 class="text-center text-2xl">Quản Lý Phản Biện - Ban Trị Sự</h1>
  </header>

  <!-- Main Content -->
  <div class="container mx-auto mt-5 grid grid-cols-2 gap-4">

    <!-- Cột 1 -->
    <div class="col-span-2 space-y-10">
        <!-- Dòng 1: Danh sách phản biện viên -->
        <div class="bg-white p-4 rounded shadow-lg h-100 overflow-y-auto">
            <h2 class="text-xl mb-4 inline-block mr-5">Danh Sách Phản Biện Viên</h2>
            <input class="form-group border-2 border-black p-1" type="text" id="searchInput">
            <table class="table table-bordered" id="phanbienvien">
                <colgroup>
                    <col  width="20%">
                    <col  width="30%">
                    <col  width="40%">
                    <col  width="10%">
                </colgroup>
            
                <thead class="bg-blue-200">
                    <tr>
                        <th>ID</th>
                        <th>Họ Tên</th>
                        <th>Email</th>
                        <th>Bài Viết Đảm Nhận</th>
                    </tr>
                </thead>
                <tbody id="table-body" >
                    <tr>
                        <td>1</td>
                        <td>Nguyễn Văn A</td>
                        <td>nva@example.com</td>
                        <td><a href="">Xem chi tiết</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Trần Thị B</td>
                        <td>ttb@example.com</td>
                        <td><a href="">Xem chi tiết</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Trần Thị C</td>
                        <td>tewwwwwweeeeeeeeeeeeeeeeeeeeeeeeeb@example.com</td>
                        <td><a href="">Xem chi tiết</a></td>
                    </tr>
                    
                    <!-- Các hàng khác -->
                </tbody>
            </table>
        </div>

        <!-- Dòng 2: Thông báo -->
        <div class="bg-white p-4 rounded shadow-lg h-32">
            <h2 class="text-xl mb-2">Thông Báo</h2>
            <p>Các phản biện viên hãy theo dõi tình trạng các bài viết đã nhận và cập nhật kết quả phản biện.</p>
        </div>
    </div>

    <!-- Cột 2: Danh sách bài viết được gửi về -->
    <div class="col-span-2 space-y-10">
        <div class="bg-white p-4 rounded shadow-lg h-100 overflow-y-auto">
            <h2 class="text-xl mb-4 inline-block mr-5">Danh Sách Bài Viết Mới</h2>
            <input class="form-group border-2 border-black p-1" type="text" id="searchInput2">
            <table class="table table-striped overflow-y-auto" id="baiviet">
                <thead class="bg-blue-200">
                    <tr>
                        <th>ID Bài Viết</th>
                        <th>Tiêu Đề</th>
                        <th>Tác Giả</th>
                        <th>Ngày Gửi</th>
                    </tr>
                </thead>
                <tbody id="table-body2" >
                    <tr>
                        <td>1</td>
                        <td>Bài Viết Về Công Nghệ</td>
                        <td>Nguyễn Văn A</td>
                        <td>01/10/2024</td>
                    </tr>
                    <!-- Các hàng khác -->
                    <tr>
                        <td>1</td>
                        <td>Bài Viết Về Công Nghệ</td>
                        <td>Nguyễn Văn A</td>
                        <td>01/10/2024</td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Ô phân công bài viết cho ban phản biện -->
    <div class="col-span-2 bg-white p-4 rounded shadow-lg mt-4">
        <h2 class="text-xl mb-4">Phân Công Bài Viết Cho Phản Biện Viên</h2>
        <form>
            <div class="grid grid-cols-2 gap-4">
                <!-- Chọn bài viết -->
                <div>
                    <label for="baiviet" class="form-label mx-2">Chọn Bài Viết</label>
                    <select class="form-select border-solid	border-2 border-slate-500" id="baiviet">
                        <option selected>Chọn bài viết</option>
                        <option value="1">Bài Viết Về Công Nghệ</option>
                        <option value="2">Bài Viết Về Môi Trường</option>
                        <option value="3">Bài Viết Về Y Học</option>
                    </select>
                </div>

                <!-- Chọn phản biện viên -->
                <div>
                    <label for="phanbienvien" class="form-label mx-2">Chọn Phản Biện Viên</label>
                    <select class="form-select border-solid	border-2 border-slate-500	" id="phanbienvien" >
                        <option selected>Chọn phản biện viên</option>
                        <option value="1">Nguyễn Văn A</option>
                        <option value="2">Trần Thị B</option>
                        <option value="3">Lê Quốc C</option>
                    </select>
                </div>
            </div>

            <!-- Nút xác nhận -->
            <div class="mt-4 text-right">
                <button type="submit" class="btn btn-primary">Phân Công</button>
            </div>
        </form>
    </div>
  </div>

  <!-- Dòng dưới: Danh sách bài viết đã phản biện -->
  <div class="container mx-auto mt-5 p-4 bg-white rounded shadow-lg">
    <h2 class="text-xl mb-4">Bài Viết Đã Phản Biện Hoàn Thành</h2>
    <table class="table table-bordered">
        <thead class="bg-blue-200">
            <tr>
                <th>ID Bài Viết</th>
                <th>Tiêu Đề</th>
                <th>Tác Giả</th>
                <th>Phản Biện Viên</th>
                <th>Trạng Thái</th>
            </tr>
        </thead>
        <tbody id="table-body">
            <tr>
                <td>1</td>
                <td>Bài Viết Về Khoa Học</td>
                <td>Nguyễn Văn B</td>
                <td>Phản Biện Viên 1</td>
                <td>
                    <label class="btn-success">Chấp Nhận</label>
                    
                </td>
            </tr>
            <!-- Các hàng khác -->
            <tr>
              <td>1</td>
              <td>Bài Viết Về Khoa Học</td>
              <td>Nguyễn Văn B</td>
              <td>Phản Biện Viên 1</td>
              <td>
                  
                  <label class="btn-danger">Từ Chối</label>
              </td>
          </tr>
        </tbody>
    </table>
  </div>

  <!-- Footer -->
  <footer class="bg-gray-800 text-white p-4 mt-8">
    <div class="text-center">
        &copy; 2024 Ban Trị Sự - Quản Lý Phản Biện
    </div>
  </footer>



    <script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>    
    <script src="/ass/JavaScript.js"></script>
</body>
</html>