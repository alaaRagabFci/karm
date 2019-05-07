<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Slider;
use App\Services\UtilityService;

class SliderService
{
    private $utilityService;
    public function __construct(UtilityService $utilityService){
        $this->utilityService = $utilityService;
    }

    /**
     * List all sliders.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listSliders()
    {
        return Slider::get();
    }

    public function sortSliders($ids)
    {
        for($i = 0; $i < count($ids); $i++){
            $slider = Slider::findOrFail($ids[$i]);
            $slider->sort = $i+1;
            $slider->save();
        }
    }

    /**
     * Datatebles
     * @param $Sliders
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($sliders)
    {
        $tableData = Datatables::of($sliders)
            ->addColumn('meal', function (Slider $slider){
                return $slider->getMeal->name;
            })
            ->editColumn('image', '<a href="javascript:;"><img src="{{ config("app.baseUrl").$image }}" class="image" width="50px" height="50px"></a>')
            ->addColumn('is_active', function (Slider $slider){
                if($slider->is_active)
                    return '<span class="label label-sm label-primary"> نشط </span>';
                else
                    return '<span class="label label-sm label-warning"> غير نشط </span>';
            })
            ->setRowId('id')
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','sliders')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'image', 'is_active'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $sliderId
     * @return Slider
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getSlider($sliderId)
    {
        try {
            $slider = Slider::findOrFail($sliderId);
            return $slider;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Slider not found');
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
    public function createSlider($parameters)
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
            $max = Slider::max('sort');
            $parameters['sort'] = $max + 1;
            $slider = new Slider();
            $slider->create($parameters);
            return response(array('msg' => 'Entity created'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity already exist'), 404);
        }
    }


    /**
     * Update user.
     * @param $username
     * @param $display_name
     * @param $phone
     * @param $image
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function updateSlider($sliderId, $parameters, $images, $image)
    {
        try {
            $slider = Slider::findOrFail($sliderId);
            if(isset($images['image']) && $images['image'] != ""){
                $data = $this->utilityService->uploadImage($images['image']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['image'] = $data['image'];
            }else{
                $parameters['image']  = $image;
            }

            $slider->update($parameters);
            return response(array('msg' => 'Entity updated'), 200);
        }
        catch(ModelNotFoundException $ex){
            return response(array('msg' => 'Entity not found'), 404);
        }
    }

    /**
     * Delete Slider.
     * @param $sliderId
     * @return Slider
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteSlider($sliderId)
    {
        return Slider::find($sliderId)->delete();
    }
}
