<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa trích dẫn</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Chỉnh sửa trích dẫn</h1>
        <form action="{{ route('citations.update', $citation->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="title">Tiêu đề</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $citation->title }}" required>
            </div>
            <div class="form-group">
                <label for="link">Liên kết</label>
                <input type="url" name="link" id="link" class="form-control" value="{{ $citation->link }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('citations.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>
</html>
