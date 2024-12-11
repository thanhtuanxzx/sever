<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article Assigned a Reviewer</title>
</head>
<body>
    <h1>Your article has been assigned a reviewer</h1>
    <p>Article Title: {{ $article_title }}</p>
    <p>Article ID: {{ $article_id }}</p>
    <a href="{{ url('/article/' . $article_id) }}">View Article</a>
</body>
</html>
