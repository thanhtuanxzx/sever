<!-- resources/views/bai_viets/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách bài viết</title>
</head>

<body>
    <h1>Danh sách bài viết</h1>
    <a href="{{ route('bai_viets.create') }}">Tạo bài viết mới</a>

    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>Chủ đề</th>
                <th>Tiêu đề</th>
                <th>Tóm tắt</th>
                <th>Ngày gửi</th>
                <th>Ngày chấp nhận</th>
                <th>Trạng thái</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($baiViets as $baiViet)
                <tr>
                    <td>{{ $baiViet->chu_de }}</td>
                    <td>{{ $baiViet->tieu_de }}</td>
                    <td>{{ $baiViet->tom_tat }}</td>
                    <td>{{ $baiViet->ngay_gui }}</td>
                    <td>{{ $baiViet->ngay_chap_nhan }}</td>
                    <td>{{ $baiViet->trang_thai }}</td>
                    <td>
                        <a href="{{ route('bai_viets.show', $baiViet->id_bai_viet) }}">Xem</a>
                        <a href="{{ route('bai_viets.edit', $baiViet->id_bai_viet) }}">Sửa</a>
                        <form action="{{ route('bai_viets.destroy', $baiViet->id_bai_viet) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>