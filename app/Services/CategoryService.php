<?php

namespace App\Services;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Yajra\Datatables\Datatables as Datatables;
use App\Models\Category;
use App\Services\UtilityService;

class CategoryService
{
    private $utilityService;
    public function __construct(UtilityService $utilityService){
        $this->utilityService = $utilityService;
    }

    /**
     * List all Categories.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function listCategories()
    {
        return Category::get();
    }

    /**
     * Datatebles
     * @param $Categories
     * @return datatable.
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function datatables($Categories)
    {
        $tableData = Datatables::of($Categories)
            ->editColumn('image', '<a href="javascript:;"><img src="{{ config("app.baseUrl").$image }}" class="image" width="50px" height="50px"></a>')
            ->addColumn('is_active', function (Category $category){
                if($category->is_active)
                    return '<span class="label label-sm label-primary"> نشط </span>';
                else
                    return '<span class="label label-sm label-warning">غير نشط</span>';
            })
            ->setRowId('id')
            ->addColumn('actions', function ($data)
            {
                return view('partials.actionBtns')->with('controller','categories')
                    ->with('id', $data->id)
                    ->render();
            })->rawColumns(['actions', 'image', 'is_active'])->make(true);

        return $tableData ;
    }

    /**
     * Get description.
     * @param $categoryId
     * @return Category
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function getCategory($categoryId)
    {
        try {
            $category = Category::findOrFail($categoryId);
            return $category;
        }
        catch(ModelNotFoundException $ex){
            return array('status' => 'false', 'message' => 'Category not found');
        }
    }

    public function sortCategories($ids)
    {
        for($i = 0; $i < count($ids); $i++){
            $category = Category::findOrFail($ids[$i]);
            $category->sort = $i+1;
            $category->save();
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
    public function createCategory($parameters)
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

            if(Category::where('name', $parameters['name'])->first())
                return \Response::json(['msg'=>'هذا القسم موجود بالفعل'],404);
            $max = Category::max('sort');
            $parameters['sort'] = $max + 1;
            $category = new Category();
            $category->create($parameters);
            return \Response::json(['msg'=>'تم التسجيل بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
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
    public function updateCategory($categoryId, $parameters, $images, $image)
    {
        try {
            $Category = Category::findOrFail($categoryId);
            if(isset($images['image']) && $images['image'] != ""){
                $data = $this->utilityService->uploadImage($images['image']);
                if(!$data['status'])
                    return response(array('msg' => $data['errors']), 404);
                $parameters['image'] = $data['image'];
            }else{
                $parameters['image']  = $image;
            }

            if(Category::where('name', $parameters['name'])->where('id', '!=', $categoryId)->first())
                return \Response::json(['msg'=>'هذا القسم موجود بالفعل'],404);

            $Category->update($parameters);
            return \Response::json(['msg'=>'تم التحديث بنجاح'],200);
        }
        catch(ModelNotFoundException $ex){
            return \Response::json(['msg'=>'حدث خطا'],404);
        }
    }

    /**
     * Delete Category.
     * @param $CategoryId
     * @return Category
     * @author Alaa <alaaragab34@gmail.com>
     */
    public function deleteCategory($CategoryId)
    {
        return Category::find($CategoryId)->delete();
    }
}
