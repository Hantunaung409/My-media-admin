<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //direct index page
    public function index(){
        $categoryData = Category::when(request('search'),function($query){
                                  $query->orWhere('title','like','%'.request('search').'%')
                                        ->orWhere('description','like','%'.request('search').'%');
                                  })
                                  ->get();

        return view('admin.category.index',compact('categoryData'));
    }

    //creating category
    public function create(Request $request){
        $this->CategoryCreationValidation($request);
        Category::create([
            'title' => $request->categoryName,
            'description' => $request->categoryDescription
        ]);
     return back();
    }

    //delete category using ajax
    public function delete(Request $request){
        Category::where('category_id',$request->id)->delete();
    }
    //delete category
    // public function delete($id){
    //     Category::where('category_id',$id)->delete();
    //     return redirect()->route('admin@categoryPage')->with(['deleteSuccess' => 'A category has been deleted Successfully!']);
    // }

    //direct category Edit page
    public function editPage($id){
        $categoryData = Category::get();
        $toUpdateData = Category::where('category_id',$id)->first();
        return view('admin.category.editPage',compact('toUpdateData','categoryData'));
    }

    //updating edited data
    public function update(Request $request){
         $this->CategoryCreationValidation($request);
         Category::where('category_id',$request->categoryId)->update([
            'title' => $request->categoryName,
            'description' => $request->categoryDescription
         ]);
         return back();
    }

    //validation for category creation
    private function CategoryCreationValidation($request){
        Validator::make($request->all(),[
            'categoryName' => 'required|unique:categories,title,'.$request->categoryId.',category_id',
            // the primary key is not categoryId and its category_id -- that is -- categoryID != category_id  so the above -- if not its gonna be like
            //  unique:categories,title,'.$request->category_id
            'categoryDescription' => 'required',
        ])->validate();
    }
}
