<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviewer Assigned</title>
</head>
<body>
    <h1>You have been assigned as a reviewer</h1>
    <p>Article ID: {{ $article_id }}</p>
    <p>Reviewer ID: {{ $reviewer_id }}</p>

    <a href="{{ url('/review/' . $article_id) }}">Review Article</a>
</body>
</html>
