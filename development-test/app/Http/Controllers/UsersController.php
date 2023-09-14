<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

use App\Models\User;

use File;
use Hash;

class UsersController extends Controller
{
    private $path_folder = 'uploads/users/';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function detail($id)
    {
        $data = User::findOrFail($id);

        return view('users.detail', compact('data'));
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('users.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email,'. $id,
            'password'  => 'same:confirm-password',
            'phone'     => 'required',
            'image'     => 'mimes:png|max:1024'
        ]);

        $data = User::findOrFail($id);

        if ($request->hasFile('image')) {
            $image      = $request->file('image');
            $image_name = Str::random(5) .'-'. time() .'.'. $image->getClientOriginalExtension();
            $request->image->move(public_path($this->path_folder), $image_name);

            if ($data->image) {
                File::delete($this->path_folder . $data->image);
            }
        } else {
            $image_name = $data->image;
        }

        $password = ($request->password != null) ? Hash::make($request->password) : $data->password;

        $data->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => $password,
            'phone'     => $request->phone,
            'company'   => $request->company,
            'division'  => $request->division,
            'image'     => $image_name
        ]);

        return redirect()->route('home')
                        ->with('success', 'Profile Updated Successfully!');
    }
}
