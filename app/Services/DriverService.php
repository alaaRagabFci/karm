<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Worker;
use App\Constants\UserRole;
use App\Services\UtilityService;

class DriverService
{
    private $utilityService;
    public function __construct(UtilityService $utilityService){
        $this->utilityService = $utilityService;
    }

    /**
     * List all Drivers.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listDrivers()
    {
        return Worker::where('type', UserRole::DRIVER)->get();
    }

    /**
     * Datatebles
     * @param $drivers
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($drivers)
    {
        $tableData = Datatables::of($drivers)
            ->editColumn('image', '<a href="javascript:;"><img src="{{ config("app.baseUrl").$image }}" class="image" width="50px" height="50px"></a>')
            ->addColumn('is_blocked', function (Worker $driver){
                if($driver->is_blocked)
                    return '<span class="label label-sm label-warning"> محظور </span>';
                else
                    return '<span class="label label-sm label-primary"> غير محظور </span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','drivers')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'image', 'is_blocked'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $driverId
     * @return Worker
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getDriver($driverId)
    {
        try {
            $driver = Worker::findOrFail($driverId);
            return $driver;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Driver not found');
        }
    }

    /**
     * Create description.
     * @param $type
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createDriver($parameters)
    {
        try {
            if(isset($parameters['image']) && $parameters['image'] != ""){
                $data = $this->utilityService->uploadImage($parameters['image']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['image'] = $data['image'];
            }else{
                return response(array('msg' => 'Image required'), 404);
            }
            $token = $this->generateDriverToken($parameters);
            $parameters['token'] = $token["token"];
            $password = $this->hashPassword($parameters['password']);
            $parameters['password'] = $password['encrypted'];
            $driver = new Worker();
            $driver->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }

    /**
     * Hash password
     * requirements={
     *      {"name"="password", "dataType"="String", "requirement"="\d+", "description"="user password"}
     *  }
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function hashPassword($password) {
        $encrypted = base64_encode($password);
        $hash = array("encrypted" => $encrypted);
        return $hash;
    }

    public function generateDriverToken($data) {
        $encrypted = base64_encode(sha1($data['username'] . $data['phone'] . $data['display_name'] . time(), true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("token" => $encrypted);
        return $hash;
    }

    public function changePassword($driver, $parameters)
    {
        $password = $this->hashPassword($parameters['password']);
        $parameters['password'] = $password['encrypted'];
        $driver->password = $parameters['password'];
        $driver->save();
        return response(array('msg' => 'Password updated'), 200);
    }
    /**
     * Update user.
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateDriver($driverId, $parameters, $images, $image)
    {
        try {
            $driver = Worker::findOrFail($driverId);
            if(isset($images['image']) && $images['image'] != ""){
                $data = $this->utilityService->uploadImage($images['image']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['image'] = $data['image'];
            }else{
                $parameters['image']  = $image;
            }

            $driver->update($parameters);
            return response(array('msg' => 'Entity updated'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity not found'), 404);
        }
    }

    /**
     * Delete Driver.
     * @param $driverId
     * @return Driver
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteDriver($driverId)
    {
        return Worker::find($driverId)->delete();
    }
}
