<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>

<body>
    <form action="/upload/upload/image" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="image">
        <button type="submit">アップロード</button>
    </form>

</body>

</html>