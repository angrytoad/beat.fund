@extends('layouts.app')

@section('title', 'Product Pricing')

@section('content')
<div class="container">
    @include('layouts.flash_message')
    <div class="row">
        <div class="col-md-3">
            @include('layouts.menus.help_menu')
            @include('layouts.menus.internal_menu')
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Product Pricing</div>
                <div class="panel-body">
                   <p>
                       There are two types of pricing available for your products <strong>Pay What You Want</strong> and
                       <strong>Fixed Pricing.</strong> It's important to know the difference and the ethos behind each type.
                       You cannot individually price songs within a product, you can only apply the pricing type to the top
                       level product.
                   </p>
                    <hr />
                    <h3>Pay What You Want (PWYW)</h3>
                    <p>
                        PWYW allows you to put control in the hands of your customers. Much like many other online stores and
                        marketplaces, the customer can dictate the price they pay for a product, this could be lower or more
                        than the average payment for a product, we personally believe this pricing is much fairer and consumer-friendly
                        but can mean you generate less revenue than using fixed pricing.
                    </p>
                    <p>
                        With PWYW, the customer can pay as little as £0.10 (around ($0.14) for a product. If you want to make your product
                        free for customers to purchase, you should set your pricing type to <strong>Fixed Pricing</strong> and set the price to 0
                    </p>
                    <hr />
                    <h3>Fixed Pricing</h3>
                    <p>
                        Fixed pricing is the more traditional way of pricing music, you set the price that it is listed on the store for, this can
                        be beneficial as it means you can be sure of how much you will make off of each product sale, and as such it means you can have a more
                        consistent income. The drawback is that you may miss sales from customers who aren't prepared to pay the price you are
                        selling the product for.
                    </p>
                    <p>
                        Fixed pricing should be used when you want a product to be Free for customers, simply the set the price to 0.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script>

    </script>
@endsection