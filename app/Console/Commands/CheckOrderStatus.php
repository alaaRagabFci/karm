<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Helpers\PushNotification;
use App\Models\Order;
use App\Models\Order_driver;

class CheckOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckOrderStatus:checkOrder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check order status & send notification';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        date_default_timezone_set('Africa/Cairo');
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //get all orders status 0
        $orders = Order::where('status','0')->get();
        if(count($orders) > 0){
            foreach ($orders as $order) {
            //get first driver
                $order_driver = Order_driver::where(['order_id' => $order->id ,'sent_at' =>NULL])
                ->first();
                //push notification to this driver
                PushNotification::push_notification([
                    "target"=>$order_driver->driver->device_id,
                    "notification_type" => config('constants.notification_types.order_request'),
                    "title"     => 'طلب جديد',
                    "driver_id" => $order_driver->id,
                    "order_id"  => $order_driver->order_id,
                    "message"   => 'طلب جديد'
                ]);
                //update sent at
                    $now = time();
                    $minute = $now + (1*60);
                    $order_driver->sent_at   = date('Y-m-d h:i:s');
                    $order_driver->expire_at = date('Y-m-d h:i:s' , $minute);
                    $order_driver->save();
            }
        }
        
    }
}
