<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use Illuminate\Http\Request;
use App\Services\MealService;
use Response;


class MealSizeController extends AbstractController {

    public $mealService, $categoryService;
    public function __construct(Request $request, MealService $mealService)
    {
        $this->middleware('auth');
        $this->mealService = $mealService;
    }

    public function getMealSizes(Request $request , $id)
    {
        $sizes = $this->mealService->getMealSizes($id);
        $tableData = $this->mealService->datatablesSizes($sizes);

        if($request->ajax())
            return $tableData;

        return view('meal-sizes.index')
            ->with('modal', 'meal-sizes')
            ->with('id', $id)
            ->with('modal_', 'أحجام الوجبة')
            ->with('tableData', $tableData);
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $mealSize = $this->mealService->createMealSize($data);
        return $mealSize;
    }

    public function destroy(Request $request, $id)
    {
        $size = $this->mealService->deleteSize($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
