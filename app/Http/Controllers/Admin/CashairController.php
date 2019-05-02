<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\CashairService;
use Response;

class CashairController extends AbstractController {

    public $cashairService;
    public function __construct(CashairService $cashairService)
    {
        $this->middleware('auth');
        $this->cashairService = $cashairService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $cashairs  = $this->cashairService->listCashairs();
        $tableData = $this->cashairService->datatables($cashairs);

        if($request->ajax())
            return $tableData;

        return view('cashairs.index')
              ->with('modal', 'cashairs')
              ->with('modal_', 'كاشير')
              ->with('tableData', $tableData);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="image", "dataType"="String", "requirement"="\d+", "description"="user image"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function store(Request $request)
    {
        $data  = $request->all();
        $data['type'] = 'Cashair';
        $data['image'] = $request->hasFile('image') ? $request->file('image') : "";
        $cashair = $this->cashairService->createCashair($data);
        return $cashair;
    }
    /**
     * Edit user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function edit(Request $request , $id)
    {
        $cashair = $this->cashairService->getCashair($id);
        session(['cashair_id'     => $cashair->id]);
        session(['image'  => $cashair->image]);
        return Response::json(['msg'=>'Adding Successfully','data'=> $cashair->toJson()]);
    }

    /**
     * Update user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"},
     *      {"name"="image", "dataType"="String", "requirement"="\d+", "description"="user image"},
     *      {"name"="phone", "dataType"="String", "requirement"="\d+", "description"="phone"},
     *      {"name"="username", "dataType"="String", "requirement"="\d+", "description"="username"},
     *      {"name"="display_name", "dataType"="String", "requirement"="\d+", "description"="display_name"},
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function update(Request $request)
    {
        $images['image'] = $request->hasFile('image') ? $request->file('image') : "";
        $data  = $request->all();

        $cashair = $this->cashairService->updateCashair(
            session('cashair_id'), $data, $images ,session('image')
        );

        return $cashair;
    }

    /**
     * Delete user.
     * requirements={
     *      {"name"="id", "dataType"="Integer", "requirement"="\d+", "description"="user id"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function destroy(Request $request, $id)
    {
        $cashair = $this->cashairService->deleteCashair($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function changePassword(Request $request, $id){
        $cashair = $this->cashairService->getCashair($id);
        return $this->cashairService->changePassword($cashair, $request->all());
    }
}
