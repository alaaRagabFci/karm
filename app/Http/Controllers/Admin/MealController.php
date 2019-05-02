<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Util\AbstractController;
use App\Services\CategoryService;
use Illuminate\Http\Request;
use App\Services\MealService;
use Response;

class MealController extends AbstractController {

    public $mealService, $categoryService;
    public function __construct(MealService $mealService, CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->mealService = $mealService;
        $this->categoryService = $categoryService;
    }

    /**
     * List all users.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function index(Request $request)
    {
        $categories  = $this->categoryService->listCategories();
        $meals  = $this->mealService->listMeals();
        $tableData = $this->mealService->datatables($meals);

        if($request->ajax())
            return $tableData;

        return view('meals.index')
              ->with('modal', 'meals')
              ->with('categories', $categories)
              ->with('modal_', 'الوجبة')
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
        $data['images'] = $request->hasFile('images') ? $request->file('images') : "";
        $category = $this->mealService->createMeal($data);
        return $category;
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
        $meal = $this->mealService->getMeal($id);
        session(['meal_id'     => $meal->id]);
        session(['image'  => $meal->image]);
        return Response::json(['msg'=>'Adding Successfully','data'=> $meal->toJson()]);
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

        $category = $this->mealService->updateMeal(
            session('meal_id'), $data, $images ,session('image')
        );

        return $category;
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
        $image = $this->mealService->deleteMeal($id);

        if($request->ajax())
        {
            return Response::json(['msg'=>'Deleted Successfully',200]);
        }
        return redirect()->back();
    }
}
