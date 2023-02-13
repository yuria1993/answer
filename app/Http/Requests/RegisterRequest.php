<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'min:8', 'max:191', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function messages() {
        return [
        "name.required" => "名前を入力してください。",
        "name.string" => "名前を文字列で入力してください。",
        "name.max" => "191文字以下で入力してください。",
        "email.required" => "メールアドレスを入力してください。",
        "email.unique" => "入力のメールアドレスは既に登録済みです。",
        "email.email" => "メールアドレスの形式で入力してください。",
        "password.required" => "パスワードを入力してください",
        "password.min" => "パスワードは8文字以上で入力してください。",
        "password.max" => "パスワードは191文字以下で入力してください。",
        "password.confirmed" => "パスワードが一致しません。",
        "password_confirmation.required" => "確認用パスワードを入力してください。",
        ];
    }
}
