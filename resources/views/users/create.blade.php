<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    
    <title>Craft by Me</title>
</head>

<body>
    <h1>投稿作成画面</h1>
        <form action="/blogs" method="POST">
            @csrf
            <div class="title-create">
                <h2>投稿タイトル</h2>
                <input type="text" name="blog[title]" placeholder="タイトル" value="{{ old('blog.title') }}"/>
                <p class="title_error" style="color:red">{{ $errors->first('blog.title') }}</p>
            </div>
            <div class="body-create">
                <h2>投稿内容</h2>
                <textarea name="blog[body]" placeholder="購入に至った経緯やストーリー">{{ old('blog.body') }}</textarea>
                <p class="body_error" style="color:red">{{ $errors->first('blog.body') }}</p>
            </div>
            <input type="submit" value="投稿する"/>
        </form>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
</body>
</html>