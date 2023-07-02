<?php
namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $images = Image::all();

        return view('auth.admin.dashboard')->with('image',$images);;
    }

    public function registerusers()
    {
      
        $users = User::orderby('created_at', 'desc')->paginate(10);
        return view('auth.admin.registerusers', compact('users'));
       
    }
}
