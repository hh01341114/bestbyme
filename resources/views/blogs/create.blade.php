<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">ブログを作成</h1>

        <!-- enctype追加 -->
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- タイトル -->
            <div class="mb-4">
                <label for="blog[title]" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" id="blog[title]" name="blog[title]"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('blog.title') }}" required>
                @error('blog.title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- 本文 -->
            <div class="mb-4">
                <label for="blog[body]" class="block text-sm font-medium text-gray-700">本文</label>
                <textarea id="blog[body]" name="blog[body]" rows="5"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('blog.body') }}</textarea>
                @error('blog.body')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- カテゴリー選択 -->
            <div class="mb-4">
                <label for="blog[category_id]" class="block text-sm font-medium text-gray-700">カテゴリー</label>
                <select id="blog[category_id]" name="blog[category_id]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    <option value="" disabled selected>カテゴリーを選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('blog.category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('blog.category_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <!-- 購入情報 -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">購入情報</label>
                <div id="items-container">
                    <!-- 購入情報入力フォーム (初期1件) -->
                    <div class="item-form flex flex-col gap-4 mb-4">
                        <input type="text" name="blog[items][0][name]" placeholder="商品名"
                               class="block w-full border-gray-300 rounded-md shadow-sm" required>
                        <input type="number" name="blog[items][0][price]" placeholder="価格"
                               class="block w-full border-gray-300 rounded-md shadow-sm" required>
                        <input type="file" name="blog[items][0][image]" class="block w-full border-gray-300 rounded-md shadow-sm">
                        <button type="button" class="remove-item-btn text-red-500 mt-2">削除</button>
                    </div>
                </div>
                <button type="button" id="add-item-btn" class="mt-2 text-blue-500">+ 購入情報を追加</button>
            </div>

            <!-- 提出ボタン -->
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    作成
                </button>
            </div>

            <!-- 戻るボタン -->
            <div class="footer" style="margin-top: 20px;">
                <a href="/" class="btn btn-secondary">戻る</a>
            </div>
        </form>
    </div>

    <!-- JavaScriptでフォームを動的に追加 -->
    <script>
        document.getElementById('add-item-btn').addEventListener('click', function () {
            const container = document.getElementById('items-container');
            const index = container.children.length;
            const div = document.createElement('div');
            div.classList.add('item-form', 'flex', 'flex-col', 'gap-4', 'mb-4');
            div.innerHTML = `
                <input type="text" name="blog[items][${index}][name]" placeholder="商品名"
                       class="block w-full border-gray-300 rounded-md shadow-sm" required>
                <input type="number" name="blog[items][${index}][price]" placeholder="価格"
                       class="block w-full border-gray-300 rounded-md shadow-sm" required>
                <input type="file" name="blog[items][${index}][image]" class="block w-full border-gray-300 rounded-md shadow-sm">
                <button type="button" class="remove-item-btn text-red-500 mt-2">削除</button>
            `;
            container.appendChild(div);
            div.querySelector('.remove-item-btn').addEventListener('click', function () {
                div.remove();
            });
        });
        document.querySelectorAll('.remove-item-btn').forEach(button => {
            button.addEventListener('click', function () {
                button.parentElement.remove();
            });
        });
    </script>
</x-app-layout>