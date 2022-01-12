<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Judge;
use App\Models\Lawyer;
use App\Models\Kesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CasesController extends Controller
{

   /*
    public function __construct() {
          $this->middleware('auth:web');
          $this->middleware('role:Admin');
          $this->middleware('role:Judge|Lawyer|Plaintiff')->only('index', 'edit', 'create', 'update', 'show');
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $kesis = Kesi::with(['lawyer', 'judge'])->latest()->paginate(10);

        return view('backend.kesis.index', compact('kesis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lawyers = Lawyer::with('user')->latest()->get();
        $judges = Judge::with('user')->latest()->get();
        
        return view('backend.kesis.create', compact('lawyers','judges'));
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'lawyer_id'   => 'required|numeric',
            'judge_id'    => 'required|numeric',
            'p_phone'     => 'required|string|max:255',
            'd_phone'     => 'required|string|max:255',
            'p_dob'       => 'required|date',
            'd_dob'       => 'required|date',
            'p_email'     => 'required|string|email|max:255|unique:kesis',
            'd_email'     => 'required|string|email|max:255|unique:kesis',
        ]);

        Kesi::create([
            'title'             => $request->title,
            'description'       => $request->description,
            'filedate'          => $request->filedate,
            'first_hearing'     => $request->first_hearing,
            'next_hearing'      => $request->next_hearing,
            'lawyer_id'         => $request->lawyer_id,
            'judge_id'          => $request->judge_id,
            'p_gender'          => $request->p_gender,
            'p_phone'           => $request->p_phone,
            'p_dob'             => $request->p_dob,
            'p_email'           => $request->p_email,
            'p_name'            => $request->p_name,
            'p_id'              => $request->p_id,
            'd_gender'          => $request->d_gender,
            'd_phone'           => $request->d_phone,
            'd_dob'             => $request->d_dob,
            'd_email'           => $request->d_email,
            'd_name'            => $request->d_name,
            'd_id'              => $request->d_id,
        ]);

        return redirect()->route('kesi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Kesi $kesi)
    {
        
        
        return view('backend.kesis.show', compact('kesi'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Kesi $kesi)
    {
        
        $lawyers = Lawyer::with('user')->latest()->get();
        $judges = Judge::with('user')->latest()->get();

        return view('backend.kesis.edit', compact('lawyers', 'judges', 'kesi'));
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
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'lawyer_id'   => 'required|numeric',
            'judge_id'    => 'required|numeric',
            'p_phone'     => 'required|string|max:255',
            'd_phone'     => 'required|string|max:255',
            'p_dob'       => 'required|date',
            'd_dob'       => 'required|date',
        ]);

        $kesi = Kesi::findOrFail($id);

        $kesi->update([
            'title'             => $request->title,
            'description'       => $request->description,
            'filedate'          => $request->filedate,
            'first_hearing'     => $request->first_hearing,
            'next_hearing'      => $request->next_hearing,
            'lawyer_id'         => $request->lawyer_id,
            'judge_id'          => $request->judge_id,
            'p_gender'          => $request->p_gender,
            'p_phone'           => $request->p_phone,
            'p_dob'             => $request->p_dob,
            'p_email'           => $request->p_email,
            'p_name'            => $request->p_name,
            'p_id'              => $request->p_id,
            'd_gender'          => $request->d_gender,
            'd_phone'           => $request->d_phone,
            'd_dob'             => $request->d_dob,
            'd_email'           => $request->d_email,
            'd_name'            => $request->d_name,
            'd_id'              => $request->d_id,
        ]);

        return redirect()->route('kesi.index', compact('kesi'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kesi $kesi)
    {
        //
    }
}
