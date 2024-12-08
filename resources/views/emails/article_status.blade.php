<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông báo về bài viết</title>
</head>
<body>
    <h1>Thông báo về bài viết</h1>
    <p>Xin chào {{ $article->user->first_name }} {{ $article->user->last_name }},</p>

    <p>Bài viết của bạn: <strong>{{ $article->title }}</strong> đã được Ban Trị Sự xử lý.</p>

    <p><strong>Kết quả:</strong> 
        @if ($decision === 'Send_to_editor')
            Bài viết đã được chuyển đến Ban Biên Tập.
        @elseif ($decision === 'Rejected')
            Bài viết bị từ chối. Bạn có thể cập nhật để gửi lại.
        @elseif ($decision === 'Not_approved')
            Bài viết không được duyệt và không thể chỉnh sửa thêm.
        @endif
    </p>

    @if ($comment)
        <p><strong>Ghi chú từ Ban Trị Sự:</strong> {{ $comment }}</p>
    @endif

    <p>Trân trọng,<br>Ban Trị Sự</p>
</body>
</html>
