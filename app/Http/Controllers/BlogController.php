<?php

namespace App\Http\Controllers;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;

class BlogController extends Controller
{
    public function index(Blog $blog)
    {
        return view('blogs.index', ['blogs' => $blog->getPaginatedWithCategory()]);
    }

    public function show(Blog $blog)
    {
        $items = $blog->items;
        return view('blogs.show')->with(['blog' => $blog,'items' => $items,]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('blogs.create')->with('categories', $categories);
    }

    public function store(BlogRequest $request, Blog $blog)
    {
        // トランザクション開始
        DB::beginTransaction();

        try {
            $validated = $request->validated(); // バリデーション済みデータの取得

            // fill関数でデータを設定
            $blog->fill([
                'title' => $validated['blog']['title'],
                'body' => $validated['blog']['body'],
                'category_id' => $validated['blog']['category_id'],
                'user_id' => auth()->id(),
            ]);

            // データベースに保存
            $blog->save();

            // 購入情報を保存
            if (isset($validated['blog']['items'])) {
                foreach ($validated['blog']['items'] as $item) {
                    $imageUrl = null;

                    // 画像がアップロードされている場合、Cloudinaryに保存
                    if (isset($item['image'])) {
                        $uploadedFile = Cloudinary::upload($item['image']->getRealPath(), [
                            'folder' => 'blogs/items',
                        ]);
                        $imageUrl = $uploadedFile->getSecurePath(); // アップロードされた画像のURL
                    }

                    // 購入情報をデータベースに保存
                    $blog->items()->create([
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $imageUrl,
                    ]);
                }
            }

            // トランザクションをコミット
            DB::commit();

            // 作成したブログの詳細画面にリダイレクト
            return redirect()->route('blogs.show', ['blog' => $blog->id]);

        } catch (\Exception $e) {
            // エラー発生時、トランザクションをロールバック
            DB::rollBack();

            // エラーをログに記録する（任意）
            \Log::error('ブログ作成中にエラーが発生: ' . $e->getMessage());

            // エラーページまたは前のページに単純にリダイレクト
            return redirect()->back();
        }
    }

    // 編集画面の表示
    public function edit(Blog $blog)
    {
        $categories = Category::all(); // カテゴリー一覧を取得
        return view('blogs.edit', compact('blog', 'categories'));
    }

    // 更新処理
    public function update(BlogRequest $request, Blog $blog)
    {
        // トランザクションを開始
        DB::beginTransaction();
    
        try {
            // バリデーション済みデータを取得
            $validated = $request->validated();
    
            // ブログ情報を更新
            $blog->fill([
                'title' => $validated['blog']['title'],
                'body' => $validated['blog']['body'],
                'category_id' => $validated['blog']['category_id'],
            ]);
            $blog->save();
    
            // 既存の購入情報をすべて削除
            foreach ($blog->items as $item) {
                $item->delete();
            }
    
            // 新しい購入情報を追加
            if (isset($validated['blog']['items'])) {
                foreach ($validated['blog']['items'] as $item) {
                    $imageUrl = $item['existing_image'] ?? null;
    
                    // 画像がアップロードされている場合はCloudinaryに保存
                    if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $uploadedFile = Cloudinary::upload($item['image']->getRealPath(), [
                            'folder' => 'blogs/items',
                        ]);
                        $imageUrl = $uploadedFile->getSecurePath(); // アップロードされた画像URL
                    }
    
                    // 購入情報を新規作成
                    $blog->items()->create([
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $imageUrl,
                    ]);
                }
            }
    
            DB::commit();
    
            // 更新後の詳細画面にリダイレクト
            return redirect()->route('blogs.show', ['blog' => $blog->id]);
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            // エラーログを記録
            \Log::error('ブログ更新中にエラーが発生: ' . $e->getMessage());
    
            return redirect()->back()->withErrors(['error' => 'ブログの更新に失敗しました。']);
        }
    }

    // ブログ削除処理
    public function delete(Blog $blog)
    {
        DB::beginTransaction();
    
        try {
            // 関連する購入情報を削除
            foreach ($blog->items as $item) {
                if ($item->image) {
                    // Cloudinary上の画像を削除
                    Cloudinary::destroy($item->image);
                }
                $item->delete();
            }
    
            // ブログを削除
            $blog->delete();
    
            DB::commit();
    
            // 削除成功後に一覧画面にリダイレクト
            return redirect()->route('blogs.index');
    
        } catch (\Exception $e) {
            DB::rollBack();
    
            // エラーログを記録
            \Log::error('ブログ削除中にエラーが発生: ' . $e->getMessage());
    
            return redirect()->back();
        }
    }
    
 }