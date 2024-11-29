<x-app-layout>
    <div class="container mx-auto mt-6">
        <!-- プロフィール情報 -->
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-2xl font-bold">{{ $user->name }} (ユーザー名)</h1>
            <p class="text-gray-700">年齢: {{ $user->age ?? '未設定' }}</p>
            <p class="text-gray-700">フォロワー: {{ $user->followers->count() }} | フォロー: {{ $user->followings->count() }}</p>
        </div>

        <!-- 最近の投稿 -->
        <h2 class="mt-6 text-xl font-semibold">最近の投稿</h2>
        <div class="grid grid-cols-3 gap-4 mt-4">
            @foreach ($user->blogs as $blog)
                <a href="{{ route('blogs.show', $blog->id) }}" class="block">
                    <div class="bg-gray-100 rounded shadow p-4">
                        <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-full h-32 object-cover rounded">
                        <p class="mt-2 text-center font-semibold">{{ $blog->title }}</p>
                    </div>
                </a>
            @endforeach
        </div>

        <a href="{{ route('dashboard') }}" class="inline-block mt-4 px-4 py-2 bg-blue-500 text-white rounded">戻る</a>
    </div>
</x-app-layout>