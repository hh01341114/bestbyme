<x-app-layout>
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">ブログを編集</h1>
        <!-- enctype追加 -->
        <form action="{{ route('blogs.update', ['blog' => $blog->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- タイトル -->
            <div class="mb-4">
                <label for="blog[title]" class="block text-sm font-medium text-gray-700">タイトル</label>
                <input type="text" id="blog[title]" name="blog[title]"
                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                       value="{{ old('blog.title', $blog->title) }}" required>
            </div>

            <!-- 本文 -->
            <div class="mb-4">
                <label for="blog[body]" class="block text-sm font-medium text-gray-700">本文</label>
                <textarea id="blog[body]" name="blog[body]" rows="5"
                          class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>{{ old('blog.body', $blog->body) }}</textarea>
            </div>

            <!-- カテゴリー選択 -->
            <div class="mb-4">
                <label for="blog[category_id]" class="block text-sm font-medium text-gray-700">カテゴリー</label>
                <select id="blog[category_id]" name="blog[category_id]"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                                {{ old('blog.category_id', $blog->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- 購入情報 -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">購入情報</label>
                <div id="items-container">
                    @foreach ($blog->items as $index => $item)
                        <div class="item-form flex flex-col gap-4 mb-4">
                            <input type="text" name="blog[items][{{ $index }}][name]" placeholder="商品名"
                                class="block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old("blog.items.$index.name", $item->name) }}" required>
                            <input type="number" name="blog[items][{{ $index }}][price]" placeholder="価格"
                                class="block w-full border-gray-300 rounded-md shadow-sm"
                                value="{{ old("blog.items.$index.price", $item->price) }}" required>
                            <!-- 既存画像の表示 -->
                            @if ($item->image)
                                <div class="flex flex-col items-start">
                                    <img id="preview-{{ $index }}" src="{{ $item->image }}" alt="商品画像"
                                        class="w-32 h-32 object-cover rounded mt-2 mb-2">
                                    <p class="text-sm text-gray-500">現在の画像が表示されています。</p>
                                </div>
                                <!-- 既存画像情報を隠しフィールドとして追加 -->
                                <input type="hidden" name="blog[items][{{ $index }}][existing_image]" value="{{ $item->image }}">
                            @endif
                            <!-- 新しい画像のアップロード -->
                            <input type="file" name="blog[items][{{ $index }}][image]" class="block w-full border-gray-300 rounded-md shadow-sm"
                                onchange="handleFileChange(event, '{{ $index }}')">
                        </div>
                    @endforeach
                </div>
                <button type="button" id="add-item-btn" class="mt-2 text-blue-500">+ 購入情報を追加</button>
            </div>

            <!-- 提出ボタン -->
            <div class="mt-6">
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                    更新
                </button>
            </div>

            <!-- 戻るボタン -->
            <div class="footer" style="margin-top: 10px;">
                <a href="/" class="btn btn-secondary">戻る</a>
            </div>
        </form>

        <!-- JavaScriptでフォームを動的に追加 -->
        <script>
            document.getElementById('add-item-btn').addEventListener('click', function () {
                const container = document.getElementById('items-container');
                const index = container.querySelectorAll('.item-form').length;

                const div = document.createElement('div');
                div.classList.add('item-form', 'flex', 'flex-col', 'gap-4', 'mb-4');
                div.innerHTML = `
                    <input type="text" name="blog[items][${index}][name]" placeholder="商品名"
                        class="block w-full border-gray-300 rounded-md shadow-sm" required>
                    <input type="number" name="blog[items][${index}][price]" placeholder="価格"
                        class="block w-full border-gray-300 rounded-md shadow-sm" required>
                    <input type="file" name="blog[items][${index}][image]" class="block w-full border-gray-300 rounded-md shadow-sm">
                    <input type="hidden" name="blog[items][${index}][existing_image]" value="">
                `;
                container.appendChild(div);
            });

            // ファイル変更時の処理
            function handleFileChange(event, index) {
                const fileInput = event.target;

                if (fileInput.files && fileInput.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        let existingPreview = fileInput.parentElement.querySelector(`#preview-${index}`);
                        if (existingPreview) {
                            existingPreview.src = e.target.result;
                        } else {
                            const img = document.createElement('img');
                            img.src = e.target.result;
                            img.id = `preview-${index}`;
                            img.alt = 'プレビュー画像';
                            img.className = 'w-32 h-32 object-cover rounded mt-2 mb-2';
                            fileInput.parentElement.insertBefore(img, fileInput);
                        }
                    };
                    reader.readAsDataURL(fileInput.files[0]);
                }
            }
        </script>
    </div>
</x-app-layout>