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
        $posts = $user->posts()->latest()->get(); // 最新の投稿を取得
        return view('profiles.users_profile', compact('user', 'posts'));
    }

    // プロフィール更新
public function update(Request $request)
{
    $user = Auth::user();

    // バリデーション
    $request->validate([
        'username' => 'required|string|min:2|max:12',
        'email' => 'required|email|unique:users,email,' . $user->id . '|min:5|max:40',
        'bio' => 'nullable|string|max:150',
        'icon_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,bmp,svg|max:2048',

        // 新しいパスワード → 入力必須＋確認用と一致
        'password' => 'required|alpha_num|min:8|max:20|confirmed',
        'password_confirmation' => 'required|alpha_num|min:8|max:20',
    ], [
        'username.required' => 'ユーザー名は必須です。',
        'username.min' => 'ユーザー名は2文字以上で入力してください。',
        'username.max' => 'ユーザー名は12文字以内で入力してください。',

        'email.required' => 'メールアドレスは必須です。',
        'email.email' => '有効なメールアドレス形式で入力してください。',
        'email.unique' => 'このメールアドレスはすでに使用されています。',
        'email.min' => 'メールアドレスは5文字以上で入力してください。',
        'email.max' => 'メールアドレスは40文字以内で入力してください。',

        'password.required' => 'パスワードは必須です。',
        'password.alpha_num' => 'パスワードは英数字で入力してください。',
        'password.min' => 'パスワードは8文字以上で入力してください。',
        'password.max' => 'パスワードは20文字以内で入力してください。',
        'password.confirmed' => '確認用パスワードが一致しません。',

        'password_confirmation.required' => '確認用パスワードも入力してください。',
        'password_confirmation.alpha_num' => '確認用パスワードは英数字で入力してください。',
        'password_confirmation.min' => '確認用パスワードは8文字以上で入力してください。',
        'password_confirmation.max' => '確認用パスワードは20文字以内で入力してください。',
    ]);

    // ユーザー情報の更新
    $user->username = $request->username;
    $user->email = $request->email;
    $user->bio = $request->bio;

    // パスワードを常に更新（バリデーション済なので安全）
    $user->password = Hash::make($request->password);

    // アイコン画像がアップロードされた場合
    if ($request->hasFile('icon_image')) {
        if ($user->icon_image) {
            $oldIconPath = public_path('storage/' . $user->icon_image);
            if (file_exists($oldIconPath)) {
                unlink($oldIconPath);
            }
        }
        $imagePath = $request->file('icon_image')->store('icons', 'public');
        $user->icon_image = $imagePath;
    }

    $user->save();

    return redirect()->route('top')->with('success', 'プロフィールを更新しました！');
}

}
