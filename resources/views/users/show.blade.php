<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">
    
    <title>Best by Me</title>
</head>

<body>
    <h1 class="post-title">
        {{ $blog->title }}
    </h1>

    <section class="content">
        <div class="post-content">
            <h1 class="post-item">itemsテーブル商品名</h1>
            <img class="post-image" src="https://dummyimage.com/200x100/000/fff" alt="thumbnail">
            <h2 class="product-info">{{ $blog->body }}</h2>
            <!-- ボタン部分 -->
            <button class="btn-follow">フォロー</button>
            <button class="btn-like">いいね</button>
        </div>
        <div class="post-content">
            <h1 class="post-item">itemsテーブル商品名</h1>
            <img class="post-image" src="https://dummyimage.com/200x100/000/fff" alt="thumbnail">
            <h2 class="product-info">{{ $blog->body }}</h2>
            <!-- ボタン部分 -->
            <button class="btn-follow">フォロー</button>
            <button class="btn-like">いいね</button>
        </div>
        <div class="post-content">
            <h1 class="post-item">itemsテーブル商品名</h1>
            <img class="post-image" src="https://dummyimage.com/200x100/000/fff" alt="thumbnail">
            <h2 class="product-info">{{ $blog->body }}</h2>
            <!-- ボタン部分 -->
            <button class="btn-follow">フォロー</button>
            <button class="btn-like">いいね</button>
        </div>
        <div class="footer">
            <a href="/">戻る</a>
        </div>
    </section>
</body>
</html>