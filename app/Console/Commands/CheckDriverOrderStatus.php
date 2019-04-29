<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order_driver;

class CheckDriverOrderStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CheckDriverOrderStatus:checkDriverStatus';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'check if driver ignore request';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $order_driver = Order_driver::where('sent_at' ,'!=', NULL)
                                    ->where('expire_at' ,'<', date('Y-m-d h:i:s'))
                                    ->where('status' , '1')
                                    ->get();

        foreach ($order_driver as $driver) {
            $driver->status = '4';
            $driver->save();
        }
    }
}
