<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    // 自分のプロフィール（編集可能）
    public function showOwnProfile()
    {
        $user = Auth::user();
        return view('profiles.profile', compact('user'));
    }

    // 他のユーザーのプロフィール（閲覧のみ）
public function show(User $user)
{
    // ユーザーの投稿を取得
    $posts = $user->posts()->latest()->get(); // 最新の投稿を取得

    // ビューにユーザーとその投稿を渡す
    return view('profiles.users_profile', compact('user', 'posts'));
}


    // プロフィール更新
    public function update(Request $request)
    {
        $user = Auth::user();

// バリデーション
$request->validate([
    'username' => 'required|string|min:2|max:12', // ユーザー名：2文字以上、12文字以内
    'email' => 'required|email|unique:users,email,' . $user->id . '|min:5|max:40', // メールアドレス：ユニークかつ自分以外のユーザーと重複しない、形式、長さ
    'bio' => 'nullable|string|max:150', // 自己紹介：150文字以内
    'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:2048', // アイコン画像：指定された形式のみ
    // パスワードバリデーション：入力された場合にのみチェック
    'password' => $request->filled('password') ? 'required|string|alpha_num|min:8|max:20|confirmed' : 'nullable', // パスワード：英数字、8文字以上、20文字以内、一致
], [
    // 日本語のエラーメッセージ
    'username.required' => 'ユーザー名は必須です。',
    'username.string' => 'ユーザー名は文字列で入力してください。',
    'username.min' => 'ユーザー名は2文字以上で入力してください。',
    'username.max' => 'ユーザー名は12文字以内で入力してください。',

    'email.required' => 'メールアドレスは必須です。',
    'email.email' => 'メールアドレスは正しい形式で入力してください。',
    'email.unique' => 'このメールアドレスは既に登録されています。',
    'email.min' => 'メールアドレスは5文字以上で入力してください。',
    'email.max' => 'メールアドレスは40文字以内で入力してください。',

    'bio.string' => '自己紹介は文字列で入力してください。',
    'bio.max' => '自己紹介は150文字以内で入力してください。',

    'icon_image.image' => 'アイコン画像は画像ファイルである必要があります。',
    'icon_image.mimes' => 'アイコン画像はjpeg、png、jpg、gif、bmp、svg形式でアップロードしてください。',
    'icon_image.max' => 'アイコン画像は最大2MBまでです。',

    'password.required' => 'パスワードは必須です。',
    'password.string' => 'パスワードは文字列で入力してください。',
    'password.alpha_num' => 'パスワードは英数字のみ使用できます。',
    'password.min' => 'パスワードは8文字以上で入力してください。',
    'password.max' => 'パスワードは20文字以内で入力してください。',
    'password.confirmed' => 'パスワード確認が一致しません。',
]);


        // データ更新
        $user->username = $request->username;
        $user->email = $request->email;
        $user->bio = $request->bio;

        // パスワード変更時にのみ更新
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // アイコン画像がアップロードされた場合
        if ($request->hasFile('icon_image')) {
            // 古いアイコン画像を削除（もし存在すれば）
            if ($user->icon_image) {
                $oldIconPath = public_path('storage/' . $user->icon_image);
                if (file_exists($oldIconPath)) {
                    unlink($oldIconPath); // 古いアイコンを削除
                }
            }

            // 新しいアイコン画像を保存
            $imagePath = $request->file('icon_image')->store('icons', 'public');
            $user->icon_image = $imagePath;
        }

        // ユーザー情報を保存
        $user->save();

        // プロフィール更新完了のメッセージ
        return redirect()->route('top')->with('success', 'プロフィールを更新しました！');
    }
}
