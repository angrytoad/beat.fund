<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 31/03/2018
 * Time: 10:24
 */

// Home > About
Breadcrumbs::register('about', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('About', route('about'));
});

// Home > Blog
Breadcrumbs::register('blog', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Blog', route('blog'));
});

// Home > Blog > [Category]
Breadcrumbs::register('category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('blog');
    $breadcrumbs->push($category->title, route('category', $category->id));
});

// Home > Blog > [Category] > [Post]
Breadcrumbs::register('post', function ($breadcrumbs, $post) {
    $breadcrumbs->parent('category', $post->category);
    $breadcrumbs->push($post->title, route('post', $post));
});




Breadcrumbs::register('home', function ($breadcrumbs) {
    if(!Auth::user()){
        $breadcrumbs->push('Home', route('welcome'));
    }else{
        $breadcrumbs->push('Home', route('home'));
    }
});

/**
 * ADMIN BREADCRUMBS
 */
Breadcrumbs::register('admin', function ($breadcrumbs) {
    $breadcrumbs->push('Admin', route('admin'));
});

Breadcrumbs::register('admin.users', function ($breadcrumbs) {
    $breadcrumbs->parent('admin');
    $breadcrumbs->push('Users', route('admin.users'));
});

Breadcrumbs::register('admin.user', function ($breadcrumbs, $user) {
    $breadcrumbs->parent('admin.users');
    $breadcrumbs->push($user->first_name.' '.$user->last_name, route('admin.user', $user->id));
});

/**
 * STORE BREADCRUMBS
 */
Breadcrumbs::register('storefront', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Store', route('storefront'));
});

Breadcrumbs::register('storefront.search', function ($breadcrumbs) {
    $breadcrumbs->parent('storefront');
    $breadcrumbs->push('Search', route('storefront.search'));
});

Breadcrumbs::register('storefront.cart', function ($breadcrumbs) {
    $breadcrumbs->parent('storefront');
    $breadcrumbs->push('Cart', route('storefront.cart'));
});

Breadcrumbs::register('storefront.checkout', function ($breadcrumbs) {
    $breadcrumbs->parent('storefront.cart');
    $breadcrumbs->push('Checkout', route('storefront.checkout'));
});

Breadcrumbs::register('storefront.checkout.guest', function ($breadcrumbs) {
    $breadcrumbs->parent('storefront.checkout');
    $breadcrumbs->push('Guest Checkout', route('storefront.checkout.guest'));
});

Breadcrumbs::register('storefront.checkout.user', function ($breadcrumbs) {
    $breadcrumbs->parent('storefront.checkout');
    $breadcrumbs->push('User Checkout', route('storefront.checkout.user'));
});

Breadcrumbs::register('artist.store', function ($breadcrumbs, $artist) {
    $breadcrumbs->parent('storefront');
    $breadcrumbs->push($artist->artist_name, route('artist.store',$artist->user->store->slug));
});

Breadcrumbs::register('artist.store.product', function ($breadcrumbs, $artist, $product) {
    $breadcrumbs->parent('artist.store',$artist);
    $breadcrumbs->push($product->name, route('artist.store.product',[$artist->user->store->slug, $product->id]));
});

/**
 * ACCOUNT BREADCRUMBS
 */
Breadcrumbs::register('account', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Account', route('account'));
});

Breadcrumbs::register('account.update_email', function ($breadcrumbs) {
    $breadcrumbs->parent('account');
    $breadcrumbs->push('Update Email', route('account.update_email'));
});

Breadcrumbs::register('account.change_email', function ($breadcrumbs) {
    $breadcrumbs->parent('account');
    $breadcrumbs->push('Update Password', route('account.change_email'));
});

Breadcrumbs::register('account.add_mobile_number', function ($breadcrumbs) {
    $breadcrumbs->parent('account');
    $breadcrumbs->push('Add a mobile number', route('account.add_mobile_number'));
});

Breadcrumbs::register('account.stripe', function ($breadcrumbs) {
    $breadcrumbs->parent('account');
    $breadcrumbs->push('Stripe', route('account.stripe'));
});

Breadcrumbs::register('account.cards', function ($breadcrumbs) {
    $breadcrumbs->parent('account');
    $breadcrumbs->push('Cards', route('account.cards'));
});

Breadcrumbs::register('account.cards.card', function ($breadcrumbs, $card) {
    $breadcrumbs->parent('account.cards');
    $breadcrumbs->push('Edit '.$card->name, route('account.cards.card',$card->id));
});


/**
 * PURCHASES BREADCRUMBS
 */
Breadcrumbs::register('purchases', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Purchases', route('purchases'));
});

Breadcrumbs::register('purchases.order', function ($breadcrumbs, $order) {
    $breadcrumbs->parent('purchases');
    $breadcrumbs->push('Order '.$order->shortid(), route('purchases.order', $order->id));
});


/**
 * PROFILE BREADCRUMBS
 */
Breadcrumbs::register('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Profile', route('profile'));
});

Breadcrumbs::register('profile.create', function ($breadcrumbs) {
    $breadcrumbs->parent('profile');
    $breadcrumbs->push('Create a Profile', route('profile.create'));
});



/**
 * PRODUCTS BREADCRUMBS
 */
Breadcrumbs::register('store', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Store', route('store'));
});

Breadcrumbs::register('store.create', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Create a Store', route('store.create'));
});

Breadcrumbs::register('store.add_banner', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Add a banner', route('store.banner.add'));
});

Breadcrumbs::register('store.add_avatar', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Add an avatar', route('store.avatar.add'));
});


Breadcrumbs::register('store.products', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Products', route('store.products'));
});

Breadcrumbs::register('store.products.create', function ($breadcrumbs) {
    $breadcrumbs->parent('store.products');
    $breadcrumbs->push('Create a Product', route('store.products.create'));
});

Breadcrumbs::register('store.products.live', function ($breadcrumbs) {
    $breadcrumbs->parent('store.products');
    $breadcrumbs->push('Live Products', route('store.products.live'));
});

Breadcrumbs::register('store.products.pending', function ($breadcrumbs) {
    $breadcrumbs->parent('store.products');
    $breadcrumbs->push('Pending Products', route('store.products.pending'));
});

Breadcrumbs::register('store.products.product', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('store.products');
    $breadcrumbs->push($product->name, route('store.products.product',$product->id));
});

Breadcrumbs::register('store.products.product.delete', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('store.products.product',$product);
    $breadcrumbs->push('Delete', route('store.products.product.delete',$product->id));
});

Breadcrumbs::register('store.products.product.add_items', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('store.products.product',$product);
    $breadcrumbs->push('Add Items', route('store.products.product.add_items',$product->id));
});

Breadcrumbs::register('store.products.product.rearrange_items', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('store.products.product',$product);
    $breadcrumbs->push('Rearrange Items', route('store.products.product.rearrange_items',$product->id));
});

Breadcrumbs::register('store.products.product.tag_items', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('store.products.product',$product);
    $breadcrumbs->push('Tag Items', route('store.products.product.tag_items',$product->id));
});

Breadcrumbs::register('store.products.product.item', function ($breadcrumbs, $product, $line_item) {
    $breadcrumbs->parent('store.products.product',$product);
    $breadcrumbs->push($line_item->name, route('store.products.product.item',[$product->id,$line_item->id]));
});

Breadcrumbs::register('store.products.product.item.delete', function ($breadcrumbs, $product, $line_item) {
    $breadcrumbs->parent('store.products.product.item',$product, $line_item);
    $breadcrumbs->push('Delete', route('store.products.product.item.delete',[$product->id,$line_item->id]));
});

/**
 * TICKETS BREADCRUMBS
 */
Breadcrumbs::register('store.tickets', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push('Tickets', route('store.tickets'));
});

Breadcrumbs::register('store.tickets.create', function ($breadcrumbs) {
    $breadcrumbs->parent('store.tickets');
    $breadcrumbs->push('Create Tickets', route('store.tickets'));
});

Breadcrumbs::register('store.tickets.all', function ($breadcrumbs) {
    $breadcrumbs->parent('store.tickets');
    $breadcrumbs->push('All Tickets', route('store.tickets.all'));
});

Breadcrumbs::register('store.tickets.ticket', function ($breadcrumbs, $ticket) {
    $breadcrumbs->parent('store.tickets');
    $breadcrumbs->push($ticket->name, route('store.tickets.ticket', $ticket->id));
});