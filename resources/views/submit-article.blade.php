<form action="{{ route('submit-article.store') }}" method="POST">
    @csrf
    <label for="title">Tiêu đề:</label>
    <input type="text" id="title" name="title" required>

    <label for="summary">Tóm tắt:</label>
    <input type="text" id="summary" name="summary" required>

    <label for="keywords">Từ khóa:</label>
    <input type="text" id="keywords" name="keywords">

    <!-- Thêm các trường khác tương ứng với form của bạn -->
    
    <button type="submit">Gửi bài báo</button>
</form>
