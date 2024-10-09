<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm trích dẫn mới</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Thêm trích dẫn mới</h1>
    <form action="{{ route('citations.store_multiple') }}" method="POST">
        @csrf
        <div id="citations-container">
            <div class="form-group citation-item">
                <label for="title[]">Tiêu đề</label>
                <input type="text" name="title[]" class="form-control" required>
                <label for="link[]">Liên kết</label>
                <input type="url" name="link[]" class="form-control" required>
            </div>
        </div>
        <button type="button" id="add-citation" class="btn btn-secondary">Thêm trích dẫn</button>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <a href="{{ route('citations.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
document.getElementById('add-citation').addEventListener('click', function() {
    var container = document.getElementById('citations-container');
    var newItem = document.createElement('div');
    newItem.classList.add('form-group', 'citation-item');
    newItem.innerHTML = `
        <label for="title[]">Tiêu đề</label>
        <input type="text" name="title[]" class="form-control" required>
        <label for="link[]">Liên kết</label>
        <input type="url" name="link[]" class="form-control" required>
    `;
    container.appendChild(newItem);
});
</script>
</body>
</html>
