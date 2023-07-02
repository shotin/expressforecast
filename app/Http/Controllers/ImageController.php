<?php
namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller

{

    public function index(){

        $image = Image::all();

        return view('auth.admin.dashboard')->with('image',$image);

    }

    public function form(){

        return view('upload');

    }

    public function upload(Request $request){

        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2040',
            'end_date' => 'required|date',
            'link' => 'required',
            // 'end_date' => 'required|date|after:created_at',
        ]);

        //    // Store the image in the storage
        //     $image = $request->file('image');
        //     $imageName = $image->getClientOriginalName();
        //     $image->storeAs('public/images', $imageName);

        //     $newImage = new Image();
        //     $newImage->image = $imageName;
        //     $newImage->end_date = $request->end_date;
        //     $newImage->save();

        //     return redirect('/admin/dashboard');

        $images = new Image;
        $image = $request->image;
        $image_name = $image->getClientOriginalName();
        $image->storeAs('public/images', $image_name);
        $images->image = $image_name;
        $images->end_date =  $request->end_date;
        $images->link =  $request->link;

        $images->save();

        return redirect('/admin/dashboard');

    }

    public function delete($id) {
        // $imagePath = public_path('public/images' . $image->image);

        // if (File::exists($imagePath)) {
        //     unlink($imagePath);
        // }

        // $image->delete();

        // return redirect('/admin/dashboard');

        $image = Image::find($id);
        Storage::delete('public/images/' . $image->image);
        $image->delete();
        return redirect('/admin/dashboard');
    }

    // public function update(Request $request, $id)
    // {
    //     $image = Image::find($id);
    //     $image->created_at = $request->input('created_at');
    //     $image->end_date = $request->input('end_date');
    //     $image->save();
    //     return redirect('/admin/dashboard');
    // }
    public function edit(Request $request, $id)
    {
        $image = Image::find($id);
        
        // Update the end_date if it exists in the request
        if ($request->has('end_date')) {
            $image->end_date = $request->input('end_date');
        }

          // Update the link if it exists in the request
          if ($request->has('link')) {
            $image->link = $request->input('link');
        }
    
        // Update the image if it exists in the request
        if ($request->hasFile('image')) {
            $uploadedImage = $request->file('image');
            $imageName = $uploadedImage->getClientOriginalName();
            $uploadedImage->storeAs('public/images', $imageName);
            $image->image = $imageName; // Assign the new filename to the 'image' attribute
        }
        
        $image->save();
        return redirect('/admin/dashboard');
    }
    
}