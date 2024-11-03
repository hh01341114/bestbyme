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
    @if ($paginatedArticles->currentPage() == 1)
        <section class="featured-articles">
            <h1>特集記事</h1>
            <ul class="grid grid-col-3">
                <li class="grid-item">
                    <article class="featured-card">
                        @foreach ($featuredArticles as $blog)
                            <a href="/blogs/{{ $blog->id }}" class="featured-card-link">
                                <h2 class="featured-card-headline">{{ $blog->title }}</h2>
                                <span class="featured-card-label">topics!</span>
                                <img src="https://dummyimage.com/200x100/000/fff" alt="thumbnail">
                                <div class="featured-card-info">
                                    <time class="card-time" datetime="yyyy-mm-dd">2024.10.17</time>
                                </div>
                            </a>
                        @endforeach
                    </article>
                </li>
            </ul>
        </section>
    @endif

        <section class="new-articles">
            <h1>新着記事</h1>
            <ul class="grid grid-col-3">
                <li class="grid-item">
                    <article class="new-card">
                        @foreach ($paginatedArticles as $blog)
                            <a href="/blogs/{{ $blog->id }}" class="new-card-link">
                                <h2 class="new-card-headline">{{ $blog->title }}</h2>
                                <span class="new-card-label">new</span>
                                <img src="https://dummyimage.com/200x100/000/fff" alt="thumbnail">
                                <div class="new-card-info">
                                    <time class="card-time" datetime="yyyy-mm-dd">{{ $blog->created_at->format('Y.m.d') }}</time>
                                </div>
                            </a>
                        @endforeach
                    </article>
                </li>
            </ul>
            <div class='paginate'>
                {{ $paginatedArticles->links() }}
            </div>
        </section>
        <a href='/users/create'>記事を投稿してみる</a>
</body>
</html>