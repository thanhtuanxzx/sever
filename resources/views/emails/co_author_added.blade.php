<!DOCTYPE html>
<html>
<head>
    <title>Bạn đã được thêm làm đồng tác giả</title>
</head>
<body>
    <h2>Chào {{ $userName }},</h2>
    <p>Chúng tôi xin thông báo rằng bạn đã được thêm làm đồng tác giả cho bài viết: <strong>{{ $articleTitle }}</strong>.</p>
    <p>Để xem bài viết, vui lòng nhấp vào liên kết dưới đây:</p>
    <a href="{{ $articleUrl }}">Xem bài viết</a>
    <br><br>
    <p>Trân trọng,<br>Đội ngũ của chúng tôi</p>
</body>
</html>
