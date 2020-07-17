<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\subcategory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = subcategory::all();
        return view('admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.subcategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $subcategory = new subcategory;
        $subcategory->name = $request->name;

        if ($request->hasFile('image')) {
           
            // unlink(public_path('images/employee/'.$employee->image));
            
            $filename = 'subcategory'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/subcategory/'),$filenameWithExtention);

            $subcategory->image = $filenameWithExtention;
        }
        $subcategory->save();
        return redirect()->back()->with('success', 'Sub Category Added Successfully');   
        // return response()->json(['success' => true, 'data' => 'Sub  Edited Successfully']);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $subcategory = subcategory::find($id);
        $subcategory->name = $request->name;

        if ($request->hasFile('image')) {
            if($subcategory->image)
            {
                unlink(public_path('images/subcategory/'.$subcategory->image));
            }
            $filename = 'subcategory'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/subcategory/'),$filenameWithExtention);

            $subcategory->image = $filenameWithExtention;
        }
        $subcategory->update();
        return redirect()->back()->with('success', 'Sub Category Updated Successfully');   
        // return response()->json(['success' => true, 'data' => 'Sub  Edited Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = subcategory::find($id);
        if($subcategory->image)
            {
                unlink(public_path('images/subcategory/'.$subcategory->image));
            }
        $subcategory->delete();
        return redirect()->back()->with('success', 'Sub Category Deleted Successfully');   
    }
}
