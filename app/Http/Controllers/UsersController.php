<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; // Userモデルをインポート
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
public function search(Request $request)
    {
     $query = $request->input('query'); // フォームから検索ワードを取得
     $userId = auth()->id(); // 現在のログインユーザーのIDを取得

        // 検索ワードがある場合のみ検索を実行
 if ($query) {
     $users = User::where('username', 'LIKE', "%{$query}%")
                ->where('id', '!=', $userId) // ログイン中のユーザーを除外
                ->get();// `username`を部分一致検索
 }
 else {
     $users = User::where('id', '!=', $userId)->get(); // 全ユーザー取得（ログイン中のユーザーを除外）
      }
        return view('users.search', compact('users', 'query'));
    }
    }
