<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Models\Type;
use App\Services\OrderService;
use Illuminate\Http\Request;
use App\Services\UserService;
use Response;

class UserController extends AbstractController {

    public $userService, $orderService;
    public function __construct(UserService $userService, OrderService $orderService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $this->orderService = $orderService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $users  = $this->userService->listUsers();
        $tableData = $this->userService->datatables($users);

        if($request->ajax())
            return $tableData;

        return view('users.index')
              ->with('modal', 'users')
              ->with('modal_', 'عضو')
              ->with('tableData', $tableData);
    }

    public function getUserOrders(Request $request, $id){
        $userOrders  = $this->orderService->getOrderDetails($id, 'user');
        $tableData = $this->orderService->userOrdersdatatables($userOrders);

        return view('users.orders')
            ->with('tableData_', $tableData);
    }

    /**
     * Update client.
     * requirements={
     *      {"name"="name_ar", "dataType"="String", "requirement"="\d+", "description"="client name ar"},
     *      {"name"="name_en", "dataType"="String", "requirement"="\d+", "description"="client name en"},
     *      {"name"="type", "dataType"="String", "requirement"="\d+", "description"="client type"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $user = $this->userService->createUser($data);
        return $user;
    }
    /**
     * Edit client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function edit(Request $request , $id)
    {
        $user = $this->userService->getUser($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $user->toJson()]);
    }

    /**
     * Update client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"},
     *      {"name"="name_ar", "dataType"="String", "requirement"="\d+", "description"="client name ar"},
     *      {"name"="name_en", "dataType"="String", "requirement"="\d+", "description"="client name en"},
     *      {"name"="type", "dataType"="String", "requirement"="\d+", "description"="client type"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function update(Request $request, $id)
    {
        $data  = $request->all();
        $user = $this->userService->updateUser($data, $id);

        return $user;
    }

    /**
     * Delete client.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="client id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function destroy(Request $request, $id)
    {
        $user = $this->userService->deleteUser($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function sendNotification(Request $request)
    {
        $message  = $request->all();
        $notification = $this->userService->sendNotification($message);

        return $notification;
    }
}
