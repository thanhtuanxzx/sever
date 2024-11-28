<?php
namespace App\Notifications;

use Illuminate\Notifications\Notification;

class CoAuthorAddedNotification extends Notification
{
    protected $article;
    protected $role;

    /**
     * Khởi tạo thông báo với bài viết và vai trò đồng tác giả.
     *
     * @param $article
     * @param $role
     */
    public function __construct($article, $role)
    {
        $this->article = $article;
        $this->role = $role;
    }

    /**
     * Xác định các kênh mà thông báo sẽ được gửi qua.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        // Chúng ta sẽ sử dụng kênh database để gửi thông báo
        return ['database'];
    }

    /**
     * Dữ liệu gửi qua kênh database.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
{
    return [
        'user_id' => $notifiable->id, // Sử dụng ID của người nhận
        'title' => "Bạn đã được thêm làm đồng tác giả", // Tiêu đề thông báo
        'message' => "Bạn đã được thêm làm đồng tác giả với vai trò {$this->role} cho bài viết: {$this->article->title}.",
        'is_read' => 0, // Mặc định chưa đọc
    ];
}


    /**
     * (Optional) Nếu bạn muốn gửi thông báo qua email
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $data = [
            'article_id' => $article->id,
            'title' => $article->title,
            'role' => $role,
            'message' => "Bạn đã thêm làm đồng tác giả với vai trò {$role} cho bài viết: {$article->title}."
        ];
        
        $user->notify(new CoAuthorAddedNotification($data));
        
    }
}
