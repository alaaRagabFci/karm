<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\MealService;
use Illuminate\Http\Request;
use App\Services\SliderService;
use Response;

class SliderController extends AbstractController {

    public $sliderService, $mealService;
    public function __construct(SliderService $sliderService, MealService $mealService)
    {
        $this->middleware('auth');
        $this->sliderService = $sliderService;
        $this->mealService = $mealService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $meals  = $this->mealService->listMeals();
        $sliders  = $this->sliderService->listSliders();
        $tableData = $this->sliderService->datatables($sliders);

        if($request->ajax())
            return $tableData;

        return view('sliders.index')
              ->with('meals', $meals)
              ->with('modal', 'sliders')
              ->with('modal_', 'عرض جديد')
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
        $data['image'] = $request->hasFile('image') ? $request->file('image') : "";
        $slider = $this->sliderService->createSlider($data);
        return $slider;
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
        $slider = $this->sliderService->getSlider($id);
        session(['slider_id'     => $slider->id]);
        session(['image'  => $slider->image]);
        return Response::json(['msg'=>'Adding Successfully','data'=> $slider->toJson()]);
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

        $slider = $this->sliderService->updateSlider(
            session('slider_id'), $data, $images ,session('image')
        );

        return $slider;
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
        $slider = $this->sliderService->deleteSlider($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function sortSliders(Request $request)
    {
        $data  = $request->all();
        $slider = $this->sliderService->sortSliders($data);

        return $slider;
    }

}
