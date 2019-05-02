<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\CountryService;
use Illuminate\Http\Request;
use App\Services\RecevingTypeService;
use Response;

class RecevingTypeController extends AbstractController {

    public $recevingTypeService;
    public function __construct(RecevingTypeService $recevingTypeService)
    {
        $this->middleware('auth');
        $this->recevingTypeService = $recevingTypeService;
    }

    /**
     * List all clients.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $recevingTypes  = $this->recevingTypeService->listReceivingTypes();
        $tableData = $this->recevingTypeService->datatables($recevingTypes);

        if($request->ajax())
            return $tableData;

        return view('receving-types.index')
              ->with('modal', 'receving-types')
              ->with('modal_', 'أليات استلام الطلبات')
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
        $recevingType = $this->recevingTypeService->createReceivingType($data);
        return $recevingType;
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
        $recevingType = $this->recevingTypeService->getReceivingType($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $recevingType->toJson()]);
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
        $recevingType = $this->recevingTypeService->updateReceivingType($data, $id);

        return $recevingType;
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
        $recevingType = $this->recevingTypeService->deleteReceivingType($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
