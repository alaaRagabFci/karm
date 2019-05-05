<?php

namespace App\Services;
use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Order;
use App\Constants\OrderStatus;

class OrderService
{
    /**
     * List all Country.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listOrders()
    {
        return Order::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('user', function (Order $order){
                return $order->getUser->username;
            })
            ->addColumn('driver', function (Order $order){
                if($order->getDriver)
                    return $order->getDriver->display_name;
                else
                    return 'لا يوجد';
            })
            ->addColumn('cashair', function (Order $order){
                if($order->getCashair)
                    return $order->getCashair->display_name;
                else
                    return 'لا يوجد';
            })
            ->addColumn('receivingType', function (Order $order){
                return $order->getReceivingType->type;
            })
            ->editColumn('status', function (Order $order){
                if($order->status == OrderStatus::CANCELLED)
                    return '<span class="label label-sm label-warning"> ملغيه </span>';
                elseif($order->status == OrderStatus::ONGOING)
                    return '<span class="label label-sm label-success">في الطريق</span>';
                else
                    return '<span class="label label-sm label-primary">تحت التجهيز</span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('orders.actionBtns')->with('controller','orders')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'user', 'driver', 'cashair', 'receivingType', 'status'])->make(true);

        return $tableData ;
    }

    public function getOrderDetails($Id, $type = null){
        if($type)
            return Order::where('the_user_id', $Id)->get();

        return OrderDetail::where('order_id', $Id)->get();
    }

    public function datatables_($orders)
    {
        $tableData = Datatables::of($orders)
            ->addColumn('meal', function (OrderDetail $order){
                return $order->getMeal->name;
            })->rawColumns(['meal'])->make(true);

        return $tableData ;
    }

    public function userOrdersdatatables($orders)
    {
        $tableData = Datatables::of($orders)
            ->editColumn('status', function (Order $order){
                if($order->status == OrderStatus::CANCELLED)
                    return '<span class="label label-sm label-warning"> ملغيه </span>';
                elseif($order->status == OrderStatus::ONGOING)
                    return '<span class="label label-sm label-success">في الطريق</span>';
                else
                    return '<span class="label label-sm label-primary">تحت التجهيز</span>';
            })->rawColumns(['status'])->make(true);

        return $tableData ;
    }

}
