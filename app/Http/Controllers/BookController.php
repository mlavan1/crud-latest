<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use DataTables;
use Illuminate\Database\Eloquent\Collection;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $book=Book::latest()->get();
        if ($request->ajax()) {
            $data = Book::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('category_name',function($row){
                        $category_name=Book::find($row->id)->category->category_name;;
                            return $category_name;
                    })
                    ->addColumn('action', function($row){
                           
                            $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBook2">Edit</a>';
                            $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBook2">Delete</a>';
                            return $btn;
                    })
                    ->rawColumns(['category_name','action'])
                    ->make(true);
        }
        return view('index',compact('book'));        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book= Book::find($id);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request);
        // $book= new Book;
        // $book-> book_name   =   $request    ->input('bookName');
        // $book-> price       =   $request    ->input('Price');
        // $book-> author      =   $request    ->input('Author');
        // $book-> category_id =   $request    ->input('categorySelector');
        // $book-> save();
        $form_data=array(
            'book_name' => $request->bookName,
            'price' => $request->Price,
            'author' => $request->Author,
            'category_id' => $request->categorySelector,
        );
        Book::find($request->book_id)->update($form_data);
        return response()->json(['success','Data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
