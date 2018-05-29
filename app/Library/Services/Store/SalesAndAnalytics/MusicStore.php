<?php
/**
 * Created by PhpStorm.
 * User: Tom
 * Date: 28/05/2018
 * Time: 00:42
 */

namespace App\Library\Services\Store\SalesAndAnalytics;

use App\Models\OrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MusicStore{
    
    private $store;
    private $user;
    
    public function __construct()
    {
    }

    public function load($user){
        $this->store = $user->store;
        $this->user = $user;
        return $this;
    }

    public function live()
    {
        return $this->store->live;
    }

    public function products($all = false){
        if($all){
            return $this->store->products()->withTrashed()->pluck('id')->toArray();
        }
        return $this->store->products()->pluck('id')->toArray();
    }

    public function getTotalProductSaleCount()
    {
        return OrderItem::whereIn('product_id',$this->products(true))
            ->get()
            ->count();
    }

    public function getTotalOrderCount()
    {
        return OrderItem::whereIn('product_id',$this->products(true))
            ->get()
            ->groupBy('order_id')
            ->count();
    }

    public function getTotalCustomerCount()
    {
        return DB::table('order_items as order_items')->whereIn('order_items.product_id',$this->products(true))
            ->join('orders as orders','orders.id','=','order_items.order_id')
            ->get()
            ->groupBy('orders.user_id')
            ->count();
    }

    public function getTotalRevenue()
    {
        return OrderItem::whereIn('product_id',$this->products(true))
            ->sum('price_paid');
    }

    public function getProductSalesBetween($start, $end)
    {
        return OrderItem::whereIn('product_id',$this->products(true))
            ->where('created_at','>',$start)
            ->where('created_at','<',$end)
            ->get();
    }

    public function getProductSales()
    {
        return OrderItem::whereIn('product_id',$this->products(true))
            ->orderBy('created_at','DESC')
            ->get();
    }

    public function getProductSalesCountChartData($start, $end)
    {
        $order_items = $this->getProductSalesBetween($start,$end);

        $dates = [];
        for($i = 0; $i < 30; $i++){
            $dates[] = $start->copy();
            $start->addDay();
        }

        $date_to_products = [];
        foreach($dates as $date){
            $date_to_products[$date->format('d/m/Y')] = [];
        }

        foreach($dates as $date){
            foreach($order_items as $order_item){
                if($date->copy()->addDay()->diffInDays($order_item->created_at, false) === -1){
                    $date_to_products[$date->format('d/m/Y')][] = $order_item;
                }
            }
        }

        $finalised_array = [];

        foreach($date_to_products as $date_to_product){
            $finalised_array[] = count($date_to_product);
        }

        return json_encode($finalised_array);
    }

    public function getChartDates($start){
        $dates = [];
        for($i = 0; $i < 30; $i++){
            $dates[] = $start->copy()->addDays($i)->format('d/m');
        }

        return json_encode($dates);
    }

}