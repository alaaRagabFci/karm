<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Promocode;

class PromocodeService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listPromocodes()
    {
        return Promocode::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($promocodes)
    {
        $tableData = Datatables::of($promocodes)
            ->addColumn('is_active', function (Promocode $promocode){
                if($promocode->is_active)
                    return '<span class="label label-sm label-primary"> نشط </span>';
                else
                    return '<span class="label label-sm label-warning">غير نشط</span>';
            })
            ->addColumn('actions', function ($data)
            {
                return view('promocodes.actionBtns')->with('controller','promocodes')
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
    public function createPromocode($parameters)
    {
        try {
            $promocode = new Promocode();
            $promocode->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }

    /**
     * Get Promocodes.
     * @param $promocodeId
     * @return Promocodes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getPromocode($promocodeId)
    {
        try {
            $promocode = Promocode::findOrFail($promocodeId);
            return $promocode;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Promocodes not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $promocodename
     * @return Promocodes
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updatePromocode($parameters, $promocodeId)
    {
        try {
            if(!isset($parameters['trips_limit']))
                $parameters['trips_limit'] = null;

            if(!isset($parameters['expiration_date']))
                $parameters['expiration_date'] = null;

            $promocode = Promocode::findOrFail($promocodeId);
            $promocode->update($parameters);
            return array('status' => 'true', 'message' => 'Promocodes updated');
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Promocodes not found');
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deletePromocode($promocodeId)
    {
        return Promocode::find($promocodeId)->delete();
    }
}
