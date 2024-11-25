<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <!-- 作成ボタン -->
        <div class="mb-4 flex justify-end">
            <a href="{{ route('blogs.create') }}" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">
                作成
            </a>
        </div>

        <h1 class="text-2xl font-bold mb-4">ブログ一覧</h1>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($blogs as $blog)
                <div class="bg-white border rounded-lg shadow-md p-4 relative">
                    <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}" class="block hover:underline">
                        <h2 class="text-lg font-semibold text-gray-800">{{ $blog->title }}</h2>
                    </a>
                    <p class="text-sm text-gray-500 mb-2">
                        カテゴリ: {{ $blog->category->name ?? '未分類' }}
                    </p>
                    <p class="text-sm text-gray-700">
                        {{ \Illuminate\Support\Str::limit($blog->body, 100, '...') }}
                    </p>
                    <p class="text-xs text-gray-400 mt-2">
                        更新日: {{ $blog->updated_at->format('Y-m-d') }}
                    </p>
                    <!-- 削除ボタン（アイコン） -->
                    @if (auth()->id() === $blog->user_id)
                        <form action="{{ route('blogs.delete', ['blog' => $blog->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');" class="absolute top-2 right-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $blogs->links() }}
        </div>
    </div>
</x-app-layout>