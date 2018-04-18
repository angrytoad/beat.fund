<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/04/18
 * Time: 23:17
 */

namespace App\Http\Controllers\Account\Admin;

use Illuminate\Http\Request;
use App\Models\User;


class AdminUserController
{

    public function list(Request $request) {

        $paginator = User::paginate(25);
        $paginator->withPath('admin/user');

        return view('account.admin.user.admin_users', [
            'users' => $paginator
        ]);

    }

    public function user(Request $request, $id) {

        if (empty($id)) {
            return redirect('/admin/users');
        } else {
            $user = User::find($id);
        }

        return view('account.admin.user.admin_user', [
            'user' => $user,
            'profile' => $user->profile
        ]);

    }

    public function store(Request $request) {

    }

}