<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 16/04/18
 * Time: 23:17
 */

namespace App\Http\Controllers\Admin;

use App\Library\Contracts\ProductStorageInterface;
use App\Models\User;


class AdminUserController
{

    public $productStorageInterface;

    public function __construct(ProductStorageInterface $productStorageInterface)
    {
        $this->productStorageInterface = $productStorageInterface;
    }

    public function users() {

        $paginator = User::where('email_verified',true)->paginate(100);
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

    public function purge($user_id) {

        try{
            $user = User::find($user_id);
            if(!$user){
                throw new \Exception('That user does not exist');
            }

            if($user->store){
                foreach($user->store->products as $product){
                    foreach($product->items as $item){
                        $this->productStorageInterface->delete($item->item_sample_key);
                        $this->productStorageInterface->delete($item->item_key);
                        $item->item_key = '';
                        $item->item_sample_key = '';
                        $item->tags()->delete();
                        $item->save();
                        $item->delete();
                    }
                    if($product->image_key){
                        $this->productStorageInterface->delete($product->image_key);
                    }
                    $product->live = false;
                    $product->image_key = null;
                    $product->image_url = null;
                    $product->save();
                    
                    $product->delete();
                }
                
                $user->store()->delete();
            }

            if($user->profile){
                foreach($user->profile->profile_links as $link){
                    $link->delete();
                }
                $user->profile()->delete();
            }

            if($user->stripe_account){
                $user->stripe_account()->delete();
            }

            return back()->with([
                'alert-success' => 'User has been successfully purged'
            ]);

        }catch(\Exception $e){
            return back()->withErrors([
                $e->getMessage()
            ]);
        }
    }

}