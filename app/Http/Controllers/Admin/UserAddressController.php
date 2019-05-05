<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\RegionService;
use App\Services\UserAddressService;
use Response;

class UserAddressController extends AbstractController {

    public $regionService, $userAddressService;
    public function __construct(RegionService $regionService, UserAddressService $userAddressService)
    {
        $this->middleware('auth');
        $this->regionService = $regionService;
        $this->userAddressService = $userAddressService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request, $id)
    {
        $addresses  = $this->userAddressService->listUserAddreses($id);
        $regions  = $this->regionService->listRegions();
        $tableData = $this->userAddressService->datatables($addresses);

        if($request->ajax())
            return $tableData;

        return view('user-addresses.index')
              ->with('regions', $regions)
              ->with('id', $id)
              ->with('modal', 'user-addresses')
              ->with('modal_', 'عناوين العضو')
              ->with('tableData', $tableData);
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
        $userAddress = $this->userAddressService->createUserAddress($data);
        return $userAddress;
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
        $userAddress = $this->userAddressService->getUserAddress($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $userAddress->toJson()]);
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
        $userAddress = $this->userAddressService->updateUserAddress($data, $id);

        return $userAddress;
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
        $userAddress = $this->userAddressService->deleteUserAddress($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
