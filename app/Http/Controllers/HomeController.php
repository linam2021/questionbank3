<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        try
        {
            $departments=DB::table('departments')
            ->select('departments.id','departments.department_name')
            ->paginate(10);
            return view('layouts.home')->with(['departments'=>$departments]);
        } catch (\Throwable $th) {
            return redirect()->route('showDepartments')->with('error',$th->getMessage());
        }
    }
}
