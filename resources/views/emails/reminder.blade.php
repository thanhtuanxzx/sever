<!DOCTYPE html>
<html>
<head>
    <title>Reminder: Review Submission Deadline Tomorrow</title>
</head>
<body>
    <p>Dear {{ $review->reviewer->name }},</p>
    <p>This is a friendly reminder that the submission deadline for the article "<?php echo e($review->article->title); ?>" is tomorrow (<?php echo e(\Carbon\Carbon::parse($review->submission_date)->format('Y-m-d')); ?>)</p>
    <p>Please make sure to review and submit the necessary feedback on time.</p>
    <p>Best regards,</p>
    <p>The Editorial Team</p>
</body>
</html>
