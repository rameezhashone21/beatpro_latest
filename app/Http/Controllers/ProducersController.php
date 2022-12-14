<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Producer;


class ProducersController extends Controller
{
    /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    // Get all pages
    $producers = Producer::get();

    return view('dashboard.admin.producers.index', compact('producers'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('dashboard.admin.producers.add');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function uploadImage($fileData, $loc)
  {
    // Get file name with extension
    $fileNameWithExt = $fileData->getClientOriginalName();
    // Get just file name
    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
    // Get just extension
    $fileExtension = $fileData->extension();
    // File name to store
    $fileNameToStore = time() . '.' . $fileExtension;
    // Finally Upload Image
    $fileData->storeAs($loc, $fileNameToStore);

    return $fileNameToStore;
  }

  public function store(Request $request)
  {
    // Validate data
    $valid = $this->validate($request, [
      'name' => 'required|string',
      'status' => 'required',
    ]);

    
    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/producers';
      $fileData = $request->file('image');
      $fileNameToStore = $this->uploadImage($fileData, $loc);
    } else {
      $fileNameToStore = 'no_img.jpg';
    }

    $data = [
      'name' => $valid['name'],
      'desc' => $request->desc,
      'image' => $fileNameToStore,
      'status' => $valid['status']
    ];
    

    // Save data into db
    $producer = Producer::create($data);

    if ($producer) {
      return redirect('/admin/producers')->with('success', 'Record created successfully.');
    } else {
      return redirect('/admin/producers')->with('error', 'Record not created!');
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function show(Page $page)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    // Get single page details

    $producer = Producer::findOrFail($id);

    return view('dashboard.admin.producers.edit', compact('producer'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
    // Validate data
    $valid = $this->validate($request, [
      'name' => 'required|string',
      'status' => 'required',
    ]);

    if ($request->hasFile('image')) {
      // Save image to folder
      $loc = '/public/producers';
      $fileData = $request->file('image');
      $fileNameToStore = $this->uploadImage($fileData, $loc);
      $data1 = [
        'image' => $fileNameToStore
      ];

      // Delete previous file
      $producer = Producer::where('id', $id)->first();
      Storage::delete('public/producers/' . $producer->image);
    }

    $data = [
      'name' => $valid['name'],
      'desc' => $request->desc,
      'status' => $valid['status']
    ];

    if ($request->hasFile('image')) {
      $data = array_merge($data1, $data);
    } else {
      $data = $data;
    }

    // Update data into db
    $producer = Producer::find($id);
    $producer = $producer->update($data);

    if ($producer) {
      return redirect('/admin/producers')->with('success', 'Record updated successfully.');
    } else {
      return redirect('/admin/producers')->with('error', 'Record not updated!');
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Page  $page
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    // Delete page
    $producer = Producer::destroy($id);

    if ($producer) {
      return redirect('/admin/producers')->with('success', 'Record Deleted Successfully.');
    } else {
      return redirect('/admin/producers')->with('error', "Record not deleted!");
    }
  }
}
