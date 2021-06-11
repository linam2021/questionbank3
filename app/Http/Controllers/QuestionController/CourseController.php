<?php

namespace App\Http\Controllers\QuestionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Course;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try
        {
            $departments=DB::table('departments')
            ->select('departments.id','departments.department_name')
            ->get();

            $courses=DB::table('courses')
            ->join('departments','courses.department_id', '=','departments.id')
            ->select('courses.id','courses.course_name','courses.course_url','departments.department_name')
            ->paginate(10);

            return view('layouts.course')->with(['courses'=> $courses, 'departments'=>$departments]);
        } catch (\Throwable $th) {
            return redirect()->route('showCourses')->with('error',$th->getMessage());
        }
    }

    public function addCourse(Request $request)
    {
        try
        {
            $input = $request->all();
            $validator = Validator::make($input,[
                'course_name'=>'required|unique:courses,course_name',
                'course_url'=>'required|unique:courses,course_url',
                'department_id'=>'required'
            ]);
            if( $validator->fails()) {
                Session::flash('course_name', $request->course_name);
                Session::flash('course_url', $request->course_url);
                Session::flash('department_id', $request->department_id);
                return redirect()->back()->withErrors($validator);
            }
            else
            {
                Course::create([
                    'course_name'=>$request->course_name,
                    'course_url'=>$request->course_url,
                    'department_id'=>$request->department_id
                ]);
                return redirect()->route('showCourses')->with('success','تم إضافة الدورة بنجاح');
            }
        } catch (\Throwable $th) {
            Session::flash('course_name', $request->course_name);
            Session::flash('course_url', $request->course_url);
            Session::flash('department_id', $request->department_id);
            return redirect()->route('showCourses')->with('error',$th->getMessage());
        }
    }

    public function deleteCourse($id)
    {
        try
        {
            $course =Course::where('id' , $id )->first();
            $question=Question::where('course_id',$id)->get();
            if($question->count()>0)
                return redirect()->back()->with('error','هذه الدورة تتضمن أسئلة، لا يمكنك حذفها إلا بعد حذف جميع الأسئلة منها');
            else
                $course->delete();
            return redirect()->back()->with('success','تم حذف الدورة بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
 }
