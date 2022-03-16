<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\BookCategory;
use App\Models\Book;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Database\Eloquent\Collection;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $category = Category::latest()->get();
        $book=Book::latest()->get();
        
        if ($request->ajax()) {
            $data = Category::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook">Edit</a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
     
        return view('index',compact('category','book'));   
        // return Book::find(3)->category->category_name;
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    public function delete($id)
    {
        Book::find($id)->delete();
        
     
        return response()->json(['success'=>'Book deleted successfully.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        Category::updateOrCreate(['id' => $request->category_id],['category_name' => $request->category_name]);     
        return response()->json(['success'=>'Book saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        
    }

    public function saveBook(Request $request)
    {
        // dd($request);
        $book= new Book;
        $book-> book_name   =   $request    ->input('bookName');
        $book-> price       =   $request    ->input('Price');
        $book-> author      =   $request    ->input('Author');
        $book-> category_id      =   $request    ->input('categorySelector');
        $book-> save();
        // $book-> category()->attach($request ->  input('categorySelector'));
        
        return response()->json(['success'=>'Book saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // public function edit(Category $category)
    public function edit($id)
    {
        

        $category= Category::find($id);
        
        return response()->json($category);
    }

    public function edit2($id){
        // dd($id);
        $book= Book::find($id);
        $category=Book::find($id)->category;
        
        return response()->json($book);
        
        
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Category::find($id)->delete();
        // Book::find($id)->delete();
        Category::find($id)->delete();
     
        // return response()->json(['success'=>'Book deleted successfully.']);
        
    }
}

