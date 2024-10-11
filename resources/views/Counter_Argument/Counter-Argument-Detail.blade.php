<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <title>Phản biện bài viết</title>
    <link rel="stylesheet" href="/ass/css/index.css">

    
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow Co-Ar-navbar">
      <div class="container-fluid">
        <a class="navbar-brand Co-Ar-brand" href="#">Chi Tiết Phản Biện</a>
      </div>
    </nav>
  
    <!-- Nội dung chi tiết phản biện -->
    <div class="container mt-5 Co-Ar-container">
      <!-- Thông tin bài viết -->
      <div class="border rounded p-4 shadow-sm mb-5 Co-Ar-article-info">
        <h2 class="text-xl font-bold mb-4 Co-Ar-title">Thông Tin Bài Viết</h2>
        <p class="mb-2"><strong>Tiêu Đề:</strong> Ứng dụng AI trong Nông nghiệp</p>
        <p class="mb-2"><strong>Tóm Tắt:</strong> Bài viết này trình bày cách ứng dụng trí tuệ nhân tạo (AI) trong ngành nông nghiệp nhằm tối ưu hóa quy trình sản xuất và cải thiện chất lượng nông sản.</p>
        <p><strong>File PDF:</strong> <a href="path-to-your-pdf.pdf" class="btn btn-primary Co-Ar-btn">Tải File PDF</a></p>
      </div>
  
      <!-- Khung chat -->
      <div class="de-ar-tab-panel-pb">
        <div class="de-ar-pb-header">
            <h4>Khung trò chuyện</h4>
        </div>
        
        <div class="de-ar-pb-content">
            <ul class="de-ar-pb-chat" id="chat-list">
                <!-- Các tin nhắn sẽ được thêm vào đây -->
            </ul>
            <div class="de-ar-pb-chat-input">
                <textarea id="message-input" placeholder="Nhập nội dung"></textarea>
                <label for="file-upload" class="file-label">
                    <i class="fa fa-paperclip"></i>
                    <input type="file" id="file-upload" style="display: none;">
                </label>
                <span id="pb-send-message"><i class="fa fa-paper-plane"></i></span>
            </div>
        </div>
        
        </div>
  
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/ass/JavaScript.js"></script>
    <!-- Chat functionality (sample JavaScript for sending messages) -->
    <script>
        // Lấy các phần tử cần thiết từ DOM
        const messageInput = document.getElementById("message-input");
        const fileUpload = document.getElementById("file-upload");
        const sendMessageBtn = document.getElementById("pb-send-message");
        const chatList = document.getElementById("chat-list");

        // Hàm để tạo ra tin nhắn
        function createMessage(content, fileName = null, fileObject = null, isOutgoing = true) {
            const li = document.createElement("li");
            li.className = isOutgoing ? "pb-chat-outgoing" : "pb-chat-incoming";

            // Thêm tên người gửi
            const senderLabel = document.createElement("label");
            senderLabel.className = "pb-chat-pb-name-acc";
            senderLabel.innerHTML = `<strong>${isOutgoing ? "Bạn"/* biến tên account*/ : "Người gửi"}</strong>`;
            li.appendChild(senderLabel);

            // Thêm nội dung tin nhắn
            const messageP = document.createElement("p");
            messageP.className = "pb-chat-content-massege";
            messageP.textContent = content;
            li.appendChild(messageP);

            // Nếu có file đính kèm
            if (fileName && fileObject) {
                const fileLink = document.createElement("a");
                fileLink.className = "pb-chat-massege-file";
                
                // Thêm biểu tượng file Word trước tên file
                fileLink.innerHTML = `<i class="fa-regular fa-file"></i> ${fileName}`;

                // Tạo URL từ đối tượng file
                const fileURL = URL.createObjectURL(fileObject);
                fileLink.href = fileURL;
                fileLink.download = fileName;  // Cho phép tải file khi nhấp vào link

                li.appendChild(fileLink);
            }

            // Thêm ngày tháng và thời gian gửi tin nhắn
            const timeDateP = document.createElement("p");
            timeDateP.className = "pb-chat-massege-time";
            const dateString = getCurrentDate();
            const timeString = getCurrentTime();
            timeDateP.textContent = `${dateString} - ${timeString}`;
            li.appendChild(timeDateP);

            return li;
        }

        // Xử lý sự kiện gửi tin nhắn
        sendMessageBtn.addEventListener("click", function() {
            const messageContent = messageInput.value.trim();
            const fileObject = fileUpload.files.length ? fileUpload.files[0] : null;
            const fileName = fileObject ? fileObject.name : null;

            if (messageContent || fileObject) {
                // Tạo tin nhắn mới
                const newMessage = createMessage(messageContent, fileName, fileObject, true);

                // Thêm tin nhắn vào danh sách
                chatList.appendChild(newMessage);

                // Cuộn xuống cuối khung chat
                chatList.scrollTop = chatList.scrollHeight;

                // Xóa nội dung nhập và file sau khi gửi
                messageInput.value = "";
                fileUpload.value = "";
            } else {
                alert("Vui lòng nhập tin nhắn hoặc chọn file để gửi.");
            }
        });
    </script>
  </body>
  </html>