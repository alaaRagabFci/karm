<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Region;

class RegionService
{
    /**
     * List all Client.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listRegions()
    {
        return Region::get();
    }

    /**
     * Datatebles
     * @param client
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($regions)
    {
        $tableData = Datatables::of($regions)
            ->addColumn('countryName', function (Region $region){
                return $region->getCountry->name;
            })
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','regions')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'countryName'])->make(true);

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
    public function createRegion($parameters)
    {
        try {
            $region = new Region();
            $region->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }

    /**
     * Get Regions.
     * @param $regionId
     * @return Regions
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getRegion($regionId)
    {
        try {
            $region = Region::findOrFail($regionId);
            return $region;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Regions not found');
        }
    }

    /**
     * Update user.
     * @param $email
     * @param $regionname
     * @return Regions
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateRegion($parameters, $regionId)
    {
        try {
            $region = Region::findOrFail($regionId);
            $region->update($parameters);
            return array('status' => 'true', 'message' => 'Regions updated');
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Regions not found');
        }
    }

    /**
     * Delete client.
     * @param $clientId
     * @return Client
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteRegion($regionId)
    {
        return Region::find($regionId)->delete();
    }
}
