<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\AdditionService;
use Illuminate\Http\Request;
use App\Services\MealService;
use Response;


class MealAdditionController extends AbstractController {

    public $mealService, $categoryService, $additionService;
    public function __construct(Request $request, MealService $mealService, AdditionService $additionService)
    {
        $this->middleware('auth');
        $this->mealService = $mealService;
        $this->additionService = $additionService;
    }

    public function getMealAdditions(Request $request , $id)
    {
        $mealAdditions = $this->mealService->getMealAdditions($id);
        $additions  = $this->additionService->listAdditions();
        $tableData = $this->mealService->datatablesAdditions($mealAdditions);

        if($request->ajax())
            return $tableData;

        return view('meal-additions.index')
            ->with('modal', 'meal-additions')
            ->with('additions', $additions)
            ->with('id', $id)
            ->with('modal_', 'أضافات الوجبة')
            ->with('tableData', $tableData);
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $mealAddition = $this->mealService->createMealAddition($data);
        return $mealAddition;
    }

    public function edit(Request $request , $id)
    {
        $mealAddition = $this->mealService->getMealAddition($id);
        return Response::json(['msg'=>'Adding Successfully','data'=> $mealAddition->toJson()]);
    }

    public function update(Request $request, $id)
    {
        $data  = $request->all();

        $category = $this->mealService->updateMealAddition($data, $id);

        return $category;
    }

    public function destroy(Request $request, $id)
    {
        $addition = $this->mealService->deleteMealAddition($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }

    public function sortMealAdditions(Request $request)
    {
        $data  = $request->all();
        $mealAddition = $this->mealService->sortMealAdditions($data);

        return $mealAddition;
    }
}
