<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách trích dẫn</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Danh sách trích dẫn</h1>
        <a href="{{ route('citations.create') }}" class="btn btn-primary">Thêm trích dẫn mới</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Liên kết</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($citations as $citation)
                <tr>
                    <td>{{ $citation->id }}</td>
                    <td>{{ $citation->title }}</td>
                    <td><a href="{{ $citation->link }}" target="_blank">{{ $citation->link }}</a></td>
                    <td>
                        <a href="{{ route('citations.show', $citation->id) }}" class="btn btn-info">Xem</a>
                        <a href="{{ route('citations.edit', $citation->id) }}" class="btn btn-warning">Chỉnh sửa</a>
                        <form action="{{ route('citations.destroy', $citation->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
