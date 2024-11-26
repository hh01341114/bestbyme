<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- ブログタイトル -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $blog->title }}</h1>

        <!-- カテゴリー表示 -->
        <p class="text-sm text-gray-500 mb-4">
            カテゴリ:
            <a href="{{ route('categories.index', ['category' => $blog->category->id]) }}"
               class="text-blue-500 hover:underline">
                {{ $blog->category->name }}
            </a>
        </p>

        <!-- ブログ本文 -->
        <section class="mb-6">
            <div class="text-gray-700 text-base leading-relaxed">
                {{ $blog->body }}
            </div>
        </section>

        <section class="mt-6">
            <div class="flex space-x-2">
            <!-- いいねボタン -->
                @if (auth()->user()->likedBlogs->contains($blog))
                    <form method="POST" action="{{ route('blogs.unlike', ['blog' => $blog->id]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            いいね解除
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('blogs.like', ['blog' => $blog->id]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">
                            いいね
                        </button>
                    </form>
                @endif
            <!-- フォローボタン -->
                @if (auth()->user()->followings->contains($blog))
                    <form method="POST" action="{{ route('unfollow', ['blog' => $blog->id]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                            フォロー解除
                        </button>
                    </form>
                @else
                    <form method="POST" action="{{ route('follow', ['blog' => $blog->id]) }}">
                        @csrf
                        <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                            フォロー
                        </button>
                    </form>
                @endif
        </section>

        <!-- 購入一覧 -->
        <section class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">購入一覧</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($blog->items as $item)
                    <div class="bg-white border rounded-lg shadow-md p-4">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $item->name }}</h3>
                        <p class="text-sm text-gray-500">¥{{ number_format($item->price) }}</p>
                        <!-- 画像の表示 -->
                        @if ($item->image)
                            <img src="{{ $item->image }}" alt="商品画像" class="w-full h-48 object-cover rounded mt-2">
                        @else
                            <p class="text-sm text-gray-400 mt-2">画像なし</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>

        <!-- 編集ボタン -->
        @if (auth()->id() === $blog->user_id)
            <section class="mt-6">
                <a href="{{ route('blogs.edit', ['blog' => $blog->id]) }}"
                   class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                    編集画面に移動
                </a>
            </section>
        @endif
        
        <!-- 戻るボタン -->
        <div class="footer" style="margin-top: 20px;">
            <a href="/" class="btn btn-secondary">戻る</a>
        </div>
    </div>
</x-app-layout>