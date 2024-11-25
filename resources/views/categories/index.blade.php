<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- カテゴリータイトル -->
        <h1 class="text-3xl font-bold text-gray-800 mb-4">
            カテゴリ: {{ $blogs[0]->category->name }}
        </h1>

        <!-- ブログ一覧 -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($blogs as $blog)
                <div class="bg-white border rounded-lg shadow-md p-4">
                    <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}" class="block hover:underline">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $blog->title }}</h2>
                    </a>
                    <p class="text-sm text-gray-500 mb-2">
                        更新日: {{ $blog->updated_at->format('Y-m-d') }}
                    </p>
                    <p class="text-sm text-gray-700">
                        {{ \Illuminate\Support\Str::limit($blog->body, 100, '...') }}
                    </p>
                </div>
            @endforeach
        </div>

        <!-- ページネーション -->
        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>