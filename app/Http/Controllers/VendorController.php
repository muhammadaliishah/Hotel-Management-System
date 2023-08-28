<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Vendor;
use Illuminate\Support\Facades\Storage;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Vendor::latest()->paginate(10);
        return view('vendors.index')->with('data', $data);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vendors.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

       $this->validate($request, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image'
        ]);
      //dd($request);
        $image_path = '';

        if ($request->hasFile('avatar')) {
            $image_path = $request->file('avatar')->store('vendors', 'public');
        }
        $input = $request->all();
       //dd($image_path);
         $input['avatar']=$image_path;
        $Vendor = Vendor::create($input);
    
        return redirect()->route('vendors.index')
                        ->with('success','Vendor created successfully');
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $Vendor = Vendor::find($id);
        return view('Vendors.show',compact('Vendor'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $Vendor = Vendor::find($id);
        return view('vendors.edit',compact('Vendor'));
    }
    
    /**
     * Update the specified resource in storage.
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $this->validate($request, [
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'avatar' => 'nullable|image'
        ]);
        $Vendor = Vendor::find($id);
        $image_path ='public/'.$Vendor->avatar;
       // dd($image_path);
        $input = $request->all();
        $Vendor->update($input);
    if ($request->hasFile('avatar')) {
                Storage::delete($image_path);
                $image_path = $request->file('avatar')->store('vendors', 'public');
                $Vendor->avatar = $image_path;
                $Vendor->save();
            
        }

        return redirect()->route('vendors.index')
                        ->with('success','Vendor updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        Vendor::find($id)->delete();
        return redirect()->route('vendors.index')
                        ->with('success','Vendor deleted successfully');
    }
}
