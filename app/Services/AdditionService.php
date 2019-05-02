<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Addition;

class AdditionService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listAdditions()
    {
        return Addition::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($additions)
    {
        $tableData = Datatables::of($additions)
            ->addColumn('meal', function (Addition $addition){
                return $addition->getMeal->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','additions')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'meal'])->make(true);

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
    public function createAddition($parameters)
    {
        try {
            $addition = new Addition();
            $addition->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }

    /**
     * Get Addition.
     * @param $additionId
     * @return Addition
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getAddition($additionId)
    {
        try {
            $addition = Addition::findOrFail($additionId);
            return $addition;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Addition not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $additionname
     * @return Addition
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateAddition($parameters, $additionId)
    {
        try {
            $addition = Addition::findOrFail($additionId);
            $addition->update($parameters);
            return array('status' => 'true', 'message' => 'Addition updated');
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Addition not found');
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteAddition($additionId)
    {
        return Addition::find($additionId)->delete();
    }
}
