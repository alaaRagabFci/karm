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
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','additions')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions'])->make(true);

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
            if(Addition::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'هذه الأضافه موجوده بالفعل'],404);
            $addition = new Addition();
            $addition->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
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
            if(Addition::where('name', $parameters['name'])->where('id', '!=', $additionId)->first())
                return \Response::json(['msg'=>'هذه الأضافه موجوده بالفعل'],404);

            $addition = Addition::findOrFail($additionId);
            $addition->update($parameters);
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
    public function deleteAddition($additionId)
    {
        return Addition::find($additionId)->delete();
    }
}
