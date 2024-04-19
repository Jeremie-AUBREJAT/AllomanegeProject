<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\category;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function editCategory()
    {
        $categories = Category::all();
        return view("category/edit")->with("categories",$categories);
    }
    // ajout de la methode
    public function create(){
        $categories = Category::all();
        return view("category/create")->with("categories",$categories);
    }
    public function createCategory(CategoryRequest $request)
    {
        $category = Category::create($request->all());
        {
            $category->save();
        }
        return redirect("category/edit");
    }
    public function update($id){
        $category = Category::find($id);
        return view("category/update")->with("category",$category);
    }
    public function updateCategory(CategoryRequest $request, $id)
    {
        $update = Category::find($id);
        $update->name = $request->input('name');
        $update->save();

        return redirect("category/edit");
    }
    public function destroyCategory($id)
    {
        $delete = Category::find($id);
        $delete->delete($id);
        return redirect("/category/edit");
    }
}
