<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Response;

class OrderController extends AbstractController {

    public $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->middleware('auth');
        $this->orderService = $orderService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $orders  = $this->orderService->listOrders();
        $tableData = $this->orderService->datatables($orders);

        if($request->ajax())
            return $tableData;

        return view('orders.index')
              ->with('modal', 'orders')
              ->with('tableData', $tableData);
    }

    public function getOrderDetails(Request $request, $id){
        $details  = $this->orderService->getOrderDetails($id);
        $tableData = $this->orderService->datatables_($details);

        return view('orders.details')
            ->with('tableData_', $tableData);
    }
}
