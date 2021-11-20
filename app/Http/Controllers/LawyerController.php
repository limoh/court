<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lawyer;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LawyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lawyers = Lawyer::with(['user'])->latest()->paginate(10);
        
        return view('backend.lawyers.index', compact('lawyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.lawyers.create');
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
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users',
            'password'          => 'required|string|min:8',
            'gender'            => 'required|string|max:255',
            'national_ID'       => 'required|string|max:20',
            'phone'             => 'required|string|max:255',
            'current_address'   => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255'
        ]);

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password)
        ]);
        
        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($user->name).'-'.$user->id.'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = 'avatar.png';
        }
        $user->update([
            'profile_picture' => $profile
        ]);

        $user->lawyer()->create([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        $user->assignRole('Lawyer');

        return redirect()->route('lawyers.index');
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
        $lawyer = Lawyer::with('user')->findOrFail($id); 

        return view('backend.lawyers.edit', compact('lawyer'));
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
         $lawyers = Lawyer::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => 'required|string|email|max:255|unique:users,email,'.$lawyers->user_id,
            'gender'            => 'required|string',
            'phone'             => 'required|string|max:255',
            'current_address'   => 'required|string|max:255',
            'permanent_address' => 'required|string|max:255'
        ]);

        if ($request->hasFile('profile_picture')) {
            $profile = Str::slug($lawyers->user->name).'-'.$lawyers->user->id.'.'.$request->profile_picture->getClientOriginalExtension();
            $request->profile_picture->move(public_path('images/profile'), $profile);
        } else {
            $profile = $lawyers->user->profile_picture;
        }

        $lawyers->user()->update([
            'name'              => $request->name,
            'email'             => $request->email,
            'profile_picture'   => $profile
        ]);

        $lawyers->update([
            'gender'            => $request->gender,
            'phone'             => $request->phone,
            'current_address'   => $request->current_address,
            'permanent_address' => $request->permanent_address
        ]);

        return redirect()->route('lawyers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lawyer = Lawyer::findOrFail($id);

        $user = User::findOrFail($lawyer->user_id);
        $user->removeRole('Lawyer');

        if ($user->delete()) {
            if($user->profile_picture != 'avatar.png') {
                $image_path = public_path() . '/images/profile/' . $user->profile_picture;
                if (is_file($image_path) && file_exists($image_path)) {
                    unlink($image_path);
                }
            }
        }

        $lawyer->delete();

        return back();
    }
}
