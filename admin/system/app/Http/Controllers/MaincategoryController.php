<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\maincategory;

class MaincategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $maincategories = maincategory::all();
        return view('admin.maincategory.index', compact('maincategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.maincategory.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $maincategory = new maincategory;
        $maincategory->name = $request->name;

        if ($request->hasFile('image')) {
           
            // unlink(public_path('images/employee/'.$employee->image));
            
            $filename = 'maincategory'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/maincategory/'),$filenameWithExtention);

            $maincategory->image = $filenameWithExtention;
        }
        $maincategory->save();
        return redirect()->back()->with('success', 'Main Category Added Successfully');   
        // return response()->json(['success' => true, 'data' => 'Main  Edited Successfully']);
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
        $maincategory = maincategory::find($id);
        $maincategory->name = $request->name;

        if ($request->hasFile('image')) {
            if($maincategory->image)
            {
                unlink(public_path('images/maincategory/'.$maincategory->image));
            }
            $filename = 'maincategory'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/maincategory/'),$filenameWithExtention);

            $maincategory->image = $filenameWithExtention;
        }
        $maincategory->update();
        return redirect()->back()->with('success', 'Main Category Updated Successfully');   
        // return response()->json(['success' => true, 'data' => 'Main  Edited Successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $maincategory = maincategory::find($id);
        if($maincategory->image)
            {
                unlink(public_path('images/maincategory/'.$maincategory->image));
            }
        $maincategory->delete();
        return redirect()->back()->with('success', 'Main Category Deleted Successfully');   
    }
}
