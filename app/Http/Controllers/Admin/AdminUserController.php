<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/04/18
 * Time: 23:17
 */

namespace App\Http\Controllers\Admin;

use App\Models\User;


class AdminUserController
{

    public function users() {

        $paginator = User::paginate(25);
        $paginator->withPath('admin/user');

        return view('admin.user.users', [
            'users' => $paginator
        ]);

    }

    public function user($id) {

        if (empty($id)) {
            return redirect(route('admin.users'))->withErrors([
                'That user doesn\'t exist'
            ]);
        } else {
            $user = User::find($id);
        }

        return view('admin.user.user', [
            'user' => $user,
            'profile' => $user->profile
        ]);

    }

    public function store() {

    }

}