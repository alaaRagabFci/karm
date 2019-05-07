<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\ReceivingType;

class RecevingTypeService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listReceivingTypes()
    {
        return ReceivingType::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($receivingTypes)
    {
        $tableData = Datatables::of($receivingTypes)
            ->addColumn('is_active', function (ReceivingType $receivingType){
                if($receivingType->is_active)
                    return '<span class="label label-sm label-primary"> نشط </span>';
                else
                    return '<span class="label label-sm label-warning">غير نشط</span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','receving-types')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'is_active'])->make(true);

        return $tableData ;
    }

    /**
     * Create client.
     * @param $clientId
     * @param $title_ar
     * @param $title_en
     * @param $description_ar
     * @param $description_en
     * @param $icon
     * @param $page
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function createReceivingType($parameters)
    {
        try {
            if(ReceivingType::where('type', $parameters['type'])->first())
                return \Response::json(['msg'=>'هذه الاليه موجوده بالفعل'],404);

            $receivingType = new ReceivingType();
            $receivingType->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Get ReceivingTypes.
     * @param $receivingTypeId
     * @return ReceivingTypes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getReceivingType($receivingTypeId)
    {
        try {
            $receivingType = ReceivingType::findOrFail($receivingTypeId);
            return $receivingType;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'ReceivingTypes not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $receivingTypename
     * @return ReceivingTypes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateReceivingType($parameters, $receivingTypeId)
    {
        try {
            if(ReceivingType::where('type', $parameters['type'])->where('id', '!=', $receivingTypeId)->first())
                return \Response::json(['msg'=>'هذه الاليه موجوده بالفعل'],404);

            $receivingType = ReceivingType::findOrFail($receivingTypeId);
            $receivingType->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteReceivingType($receivingTypeId)
    {
        return ReceivingType::find($receivingTypeId)->delete();
    }
}
