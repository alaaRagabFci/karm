<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Worker;
use App\Constants\UserRole;
use App\Services\UtilityService;

class CashairService
{
    private $utilityService;
    public function __construct(UtilityService $utilityService){
        $this->utilityService = $utilityService;
    }

    /**
     * List all Cashairs.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listCashairs()
    {
        return Worker::where('type', UserRole::CASHAIR)->get();
    }

    /**
     * Datatebles
     * @param $Cashairs
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($Cashairs)
    {
        $tableData = Datatables::of($Cashairs)
            ->editColumn('image', '<a href="javascript:;"><img src="{{ config("app.baseUrl").$image }}" class="image" width="50px" height="50px"></a>')
            ->addColumn('is_blocked', function (Worker $Cashair){
                if($Cashair->is_blocked)
                    return '<span class="label label-sm label-warning"> محظور </span>';
                else
                    return '<span class="label label-sm label-primary"> غير محظور </span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','cashairs')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'image', 'is_blocked'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $CashairId
     * @return Worker
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getCashair($CashairId)
    {
        try {
            $Cashair = Worker::findOrFail($CashairId);
            return $Cashair;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Cashair not found');
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
    public function createCashair($parameters)
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
            $token = $this->generateCashairToken($parameters);
            $parameters['token'] = $token["token"];
            $password = $this->hashPassword($parameters['password']);
            $parameters['password'] = $password['encrypted'];

            if(Worker::where('username', $parameters['username'])->where('type', UserRole::CASHAIR)->first())
                return \Response::json(['msg'=>'أسم الموصل موجود بالفعل'],404);

            if(Worker::where('phone', $parameters['phone'])->where('type', UserRole::CASHAIR)->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            $Cashair = new Worker();
            $Cashair->create($parameters);
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

    public function changePassword($cashair, $parameters)
    {
        $password = $this->hashPassword($parameters['password']);
        $parameters['password'] = $password['encrypted'];
        $cashair->password = $parameters['password'];
        $cashair->save();
        return response(array('msg' => 'Password updated'), 200);
    }

    public function generateCashairToken($data) {
        $encrypted = base64_encode(sha1($data['username'] . $data['phone'] . $data['display_name'] . time(), true));
        $encrypted = str_replace("/","",$encrypted);
        $hash = array("token" => $encrypted);
        return $hash;
    }

    /**
     * Update user.
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateCashair($cashairId, $parameters, $images, $image)
    {
        try {
            $Cashair = Worker::findOrFail($cashairId);
            if(isset($images['image']) && $images['image'] != ""){
                $data = $this->utilityService->uploadImage($images['image']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['image'] = $data['image'];
            }else{
                $parameters['image']  = $image;
            }

            if(Worker::where('username', $parameters['username'])->where('type', UserRole::CASHAIR)->where('id', '!=', $cashairId)->first())
                return \Response::json(['msg'=>'أسم المستخدم موجود بالفعل'],404);

            if(Worker::where('phone', $parameters['phone'])->where('type', UserRole::CASHAIR)->where('id', '!=', $cashairId)->first())
                return \Response::json(['msg'=>'رقم الجوال موجود بالفعل'],404);

            $Cashair->update($parameters);
            return \Response::json(['msg'=>'تم تحديث الكاشير بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete Cashair.
     * @param $CashairId
     * @return Cashair
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteCashair($CashairId)
    {
        return Worker::find($CashairId)->delete();
    }
}
