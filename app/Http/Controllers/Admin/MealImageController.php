<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\MealService;
use Response;


class MealImageController extends AbstractController {

    public $mealService, $categoryService;
    public function __construct(Request $request, MealService $mealService)
    {
        $this->middleware('auth');
        $this->mealService = $mealService;
    }

    public function getMealImages(Request $request , $id)
    {
        $images = $this->mealService->getMealImages($id);
        $tableData = $this->mealService->datatables_($images);

        if($request->ajax())
            return $tableData;

        return view('meal-images.index')
            ->with('modal', 'meal-images')
            ->with('modal_', 'صور الوجبة')
            ->with('id', $id)
            ->with('tableData', $tableData);
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $data['images'] = $request->hasFile('images') ? $request->file('images') : "";
        $mealImage = $this->mealService->createMealImages($data);
        return $mealImage;
    }

    public function destroy(Request $request, $id)
    {
        $image = $this->mealService->deleteImage($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
