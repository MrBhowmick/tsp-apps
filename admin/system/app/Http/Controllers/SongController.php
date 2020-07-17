<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\song;
use App\maincategory;
use App\subcategory;
use App\tag;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $songs = song::all();
        return view('admin.song.index', compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $maincategories   = maincategory::all();
        $subcategories    = subcategory::all();
        $tags             = tag::all()->pluck('name');
        $tags             = json_encode($tags);

        return view('admin.song.add', compact('maincategories','subcategories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'                  => 'required',
            'maincategory'          => 'required',
            'subcategory'           => 'required',
            'image'                 => 'required',
            'tags'                  => 'required',
            'song_url'              => 'required|url|unique:songs,song_url',
        ]);

        // return $request->all();
        $song = new song;
        $song->name = $request->name;

        if ($request->hasFile('image')) {
           
            // unlink(public_path('images/employee/'.$employee->image));
            
            $filename = 'song'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/song/'),$filenameWithExtention);

            $song->image = $filenameWithExtention;
        }
        $song->maincategory_id  = $request->maincategory;
        $song->song_url         = $request->song_url;
        $song->save();

        // attach subcategory
        $song->subcategory()->attach($request->subcategory);

        // get all tag and designed a array
        $chk_all_tags = array();
        $all_tags = tag::all()->pluck('name');
        foreach ($all_tags as $key => $value) {
            array_push($chk_all_tags, $value);
        }
        
        // new tag insert 
        $tags = $request->tags;
        $tags = explode(',',$tags);
        foreach ($tags as $tag) {

            if(in_array($tag, $chk_all_tags)){
                $exsisting_tag_id = tag::select('id')->where('name',$tag)->get();
                $song->tags()->attach($exsisting_tag_id);

            }else{
                $new_tag = new tag;
                $new_tag->name = $tag;
                $new_tag->save();
                $song->tags()->attach($new_tag->id);
            }
        }

        // $all_tags_for_pivot_table = tag::all();
        
        return redirect()->back()->with('success', 'Song Added Successfully');   
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
        $tags = tag::all()->pluck('name');
        $maincategories = maincategory::all();
        $subcategories = subcategory::all();
        $song = song::find($id);
        return view('admin.song.edit', compact('song','tags','maincategories','subcategories'));
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
        $request->validate([
            'name'                  => 'required',
            'maincategory'          => 'required',
            'subcategory'           => 'required',
            'tags'                  => 'required',
            'song_url'              => 'required|url|unique:songs,song_url,'.$id,
        ]);

        // return $request->all();
        $song = song::find($id);
        $song->name = $request->name;

        if ($request->hasFile('image')) {
            if($song->image){
                unlink(public_path('images/song/'.$song->image));
            }
            
            $filename = 'song'.time();

            $fileextention = $request->file('image')->getClientOriginalExtension();

            $filenameWithExtention = $filename.'.'.$fileextention;

            $request->file('image')->move(public_path('images/song/'),$filenameWithExtention);

            $song->image = $filenameWithExtention;
        }
        $song->maincategory_id  = $request->maincategory;
        $song->song_url         = $request->song_url;
        $song->update();

        // attach subcategory
        $song->subcategory()->sync($request->subcategory);

        // get all tag and designed a array
        $chk_all_tags = array();
        $all_tags = tag::all()->pluck('name');
        foreach ($all_tags as $key => $value) {
            array_push($chk_all_tags, $value);
        }
        
        // new tag insert 
        $tags = $request->tags;
        $tags = explode(',',$tags);
        foreach ($tags as $tag) {
            if(!in_array($tag, $chk_all_tags)){
                $new_tag = new tag;
                $new_tag->name = $tag;
                $new_tag->save();
                // $song->tags()->attach($new_tag->id);
            }
        }

        // update tags in pivaot table
        $request_tags_id = array();
        $all_tags2 = tag::all()->pluck('name','id');
        foreach ($all_tags2 as $key => $value) {
            if(in_array($value, $tags))
            {
                array_push($request_tags_id, $key);
            }
        }
        $song->tags()->sync($request_tags_id);
        // $all_tags_for_pivot_table = tag::all();
        
        return redirect()->back()->with('success', 'Song Updated Successfully');   
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
        $song = song::find($id);
        if($song->image)
        {
            unlink(public_path('images/song/'.$song->image));
        }
        $song->tags()->sync([]);
        $song->subcategory()->detach();
        $song->delete();
        return redirect()->back()->with('success', 'Song Deleted Successfully');   
    }
}
