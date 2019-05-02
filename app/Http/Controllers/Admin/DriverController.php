<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\DriverService;
use Response;

class DriverController extends AbstractController {

    public $driverService;
    public function __construct(DriverService $driverService)
    {
        $this->middleware('auth');
        $this->driverService = $driverService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $drivers  = $this->driverService->listDrivers();
        $tableData = $this->driverService->datatables($drivers);

        if($request->ajax())
            return $tableData;

        return view('drivers.index')
              ->with('modal', 'drivers')
              ->with('modal_', 'موصل')
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
        $data['type'] = 'Driver';
        $data['image'] = $request->hasFile('image') ? $request->file('image') : "";
        $driver = $this->driverService->createDriver($data);
        return $driver;
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
        $driver = $this->driverService->getDriver($id);
        session(['driver_id'     => $driver->id]);
        session(['image'  => $driver->image]);
        return Response::json(['msg'=>'Adding Successfully','data'=> $driver->toJson()]);
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

        $driver = $this->driverService->updateDriver(
            session('driver_id'), $data, $images ,session('image')
        );

        return $driver;
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
        $driver = $this->driverService->deleteDriver($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function changePassword(Request $request, $id){
        $driver = $this->driverService->getDriver($id);
        return $this->driverService->changePassword($driver, $request->all());
    }
}
