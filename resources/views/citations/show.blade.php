<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết trích dẫn</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Chi tiết trích dẫn</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Tiêu đề</h5>
                <p class="card-text">{{ $citation->title }}</p>
                <h5 class="card-title">Liên kết</h5>
                <p class="card-text"><a href="{{ $citation->link }}" target="_blank">{{ $citation->link }}</a></p>
            </div>
        </div>
        <a href="{{ route('citations.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</body>
</html>
