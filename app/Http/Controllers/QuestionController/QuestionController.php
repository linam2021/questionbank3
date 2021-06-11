<?php

namespace App\Http\Controllers\QuestionController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showQuestions($id)
    {
        try
        {
            $course=DB::table('courses')
            ->join('departments','courses.department_id', '=','departments.id')
            ->select('courses.id','courses.course_name','courses.course_url','departments.department_name')
            ->where('courses.id',$id)
            ->first();

            $questions =Question::where('course_id',$id)
            ->orderby('id')
            ->paginate(10);

            return view('layouts.question')->with(['course'=> $course,'questions'=>$questions]);
        } catch (\Throwable $th) {
            return redirect()->route('showQuestions', ['id'=>$id])->with('error',$th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try
        {
            $user_id = Auth::id();
            $input = $request->all();
            $validator = Validator::make($input,[
                'question_text'=>'required|unique:questions,question_text',
                // 'question_image'=>'nullable|mimes:jpg,jpeg,png|max:5048',
                'answer_a'=>'required',
                'answer_b'=>'required',
                'answer_c'=>'required',
                'correct_answer'=>'required',
                'video_number'=>'required|numeric',
                'question_level'=>'required',
                'course_id'=>'required',
                'sub_question_text'=>'required|different:question_text|unique:questions,question_text',
                // 'sub_question_image'=>'nullable|mimes:jpg,jpeg,png|max:5048',
                'sub_answer_a'=>'required',
                'sub_answer_b'=>'required',
                'sub_answer_c'=>'required',
                'sub_correct_answer'=>'required'
            ]);

            if( $validator->fails()) {
                Session::flash('question_text', $request->question_text);
                Session::flash('answer_a', $request->answer_a);
                Session::flash('answer_b', $request->answer_b);
                Session::flash('answer_c', $request->answer_c);
                Session::flash('correct_answer', $request->correct_answer);
                Session::flash('video_number', $request->video_number);
                Session::flash('question_level', $request->question_level);
                Session::flash('sub_question_text', $request->sub_question_text);
                Session::flash('sub_answer_a', $request->sub_answer_a);
                Session::flash('sub_answer_b', $request->sub_answer_b);
                Session::flash('sub_answer_c', $request->sub_answer_c);
                Session::flash('sub_correct_answer', $request->sub_correct_answer);
                return redirect()->back()->withErrors($validator);
            }
            else
            {
                // if (is_null($request->question_image))
                // {
                    $addPQues=Question::create([
                        'question_text'=>$request->question_text,
                        'answer_a'=>$request->answer_a,
                        'answer_b'=>$request->answer_b,
                        'answer_c'=>$request->answer_c,
                        'correct_answer'=>$request->correct_answer,
                        'user_id'=>$user_id,
                        'video_number'=>$request->video_number,
                        'question_level'=>$request->question_level,
                        'course_id'=>$request->course_id
                    ]);
                // }
                // else
                // {
                //     $newImageName=time() . '-' . $request->question_image->getClientOriginalName();
                //     $request->question_image->move(public_path("/question_images"),$newImageName);
                //     $imageURL=url('/question_images'.'/'.$newImageName);
                //     $addPQues=Question::create([
                //         'question_text'=>$request->question_text,
                //         'question_image'=> $imageURL,
                //         'answer_a'=>$request->answer_a,
                //         'answer_b'=>$request->answer_b,
                //         'answer_c'=>$request->answer_c,
                //         'correct_answer'=>$request->correct_answer,
                //         'user_id'=>$user_id,
                //         'video_number'=>$request->video_number,
                //         'question_level'=>$request->question_level,
                //         'course_id'=>$request->course_id
                //     ]);
                // }
                // if (is_null($request->sub_question_image))
                // {
                    $addSubQues=Question::create([
                        'question_text'=>$request->sub_question_text,
                        'answer_a'=>$request->sub_answer_a,
                        'answer_b'=>$request->sub_answer_b,
                        'answer_c'=>$request->sub_answer_c,
                        'correct_answer'=>$request->sub_correct_answer,
                        'user_id'=>$user_id,
                        'primary_question_id'=>$addPQues->id,
                        'course_id'=>$request->course_id
                    ]);
                // }
                // else
                // {
                //     $newImageName=time() . '-' . $request->sub_question_image->getClientOriginalName();
                //     $request->sub_question_image->move(public_path("/question_images"),$newImageName);
                //     $imageURL=url('/question_images'.'/'.$newImageName);
                //     $addSubQues=Question::create([
                //         'question_text'=>$request->sub_question_text,
                //         'question_image'=> $imageURL,
                //         'answer_a'=>$request->sub_answer_a,
                //         'answer_b'=>$request->sub_answer_b,
                //         'answer_c'=>$request->sub_answer_c,
                //         'correct_answer'=>$request->sub_correct_answer,
                //         'user_id'=>$user_id,
                //         'primary_question_id'=>$addPQues->id,
                //         'course_id'=>$request->course_id
                //     ]);
                // }
            return redirect()->route('showQuestions', ['id'=>$request->course_id])->with('success','تم إضافة السؤالين الأساسي والفرعي بنجاح');
            }
        }catch (\Throwable $th) {
            Session::flash('question_text', $request->question_text);
                Session::flash('answer_a', $request->answer_a);
                Session::flash('answer_b', $request->answer_b);
                Session::flash('answer_c', $request->answer_c);
                Session::flash('correct_answer', $request->correct_answer);
                Session::flash('video_number', $request->video_number);
                Session::flash('question_level', $request->question_level);
                Session::flash('sub_question_text', $request->sub_question_text);
                Session::flash('sub_answer_a', $request->sub_answer_a);
                Session::flash('sub_answer_b', $request->sub_answer_b);
                Session::flash('sub_answer_c', $request->sub_answer_c);
                Session::flash('sub_correct_answer', $request->sub_correct_answer);
            return redirect()->route('showQuestions', ['id'=>$request->course_id])->with('error',$th->getMessage());
        }
    }

    public function edit($id,$page)
    {
        try
        {
            $question=Question::find($id);
            $subquestion=Question::where ('primary_question_id',$id)->first();

            return view('layouts.editquestion')->with(['question'=>$question,'subquestion'=>$subquestion,'page'=>$page]);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function update(Request $request, $id,$page)
    {
        try
        {
            $question=Question::find($id);
            $subquestion=Question::where ('primary_question_id',$id)->first();
            $input = $request->all();
            $validator = Validator::make($input,[
                'question_text'=>'required',
                // 'question_image'=>'nullable|mimes:jpg,jpeg,png|max:5048',
                'answer_a'=>'required',
                'answer_b'=>'required',
                'answer_c'=>'required',
                'correct_answer'=>'required',
                'video_number'=>'required|numeric',
                'question_level'=>'required',
                'sub_question_text'=>'required|different:question_text',
                'sub_question_image'=>'nullable|mimes:jpg,jpeg,png|max:5048',
                'sub_answer_a'=>'required',
                'sub_answer_b'=>'required',
                'sub_answer_c'=>'required',
                'sub_correct_answer'=>'required'
            ]);
            if ($validator->fails()) {
               return redirect()->back()->withErrors($validator);
            }
            else
            {
                // if ($request->has('question_image')) {
                //     $newImageName=time() . '-' . $request->question_image->getClientOriginalName();
                //     $request->question_image->move(public_path("/question_images"),$newImageName);
                //     $imageURL=url('/question_images'.'/'.$newImageName);
                //     $question->question_image=$imageURL;
                // }
                $question->question_text=$input['question_text'];
                $question->answer_a=$input['answer_a'];
                $question->answer_b=$input['answer_b'];
                $question->answer_c=$input['answer_c'];
                $question->correct_answer=$input['correct_answer'];
                $question->video_number=$input['video_number'];
                $question->correct_answer=$input['correct_answer'];
                $question->question_level=$input['question_level'];
                $question->save();
                // if ($request->has('sub_question_image')) {
                //     $newImageName=time() . '-' . $request->sub_question_image->getClientOriginalName();
                //     $request->sub_question_image->move(public_path("/question_images"),$newImageName);
                //     $imageURL=url('/question_images'.'/'.$newImageName);
                //     $subquestion->question_image=$imageURL;
                // }
                $subquestion->question_text=$input['sub_question_text'];
                $subquestion->answer_a=$input['sub_answer_a'];
                $subquestion->answer_b=$input['sub_answer_b'];
                $subquestion->answer_c=$input['sub_answer_c'];
                $subquestion->correct_answer=$input['sub_correct_answer'];
                $subquestion->correct_answer=$input['sub_correct_answer'];
                $subquestion->save();
                return redirect('showQuestions/'.$question->course_id.'?page='.$page)->with(['id'=>$question->course_id])->with('success','تم تعديل السؤالين الأساسي والفرعي بنجاح');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function delete( $id)
    {
        try
        {
            $subquestion = Question::where('primary_question_id' , $id )->first();
            $question = Question::where('id' , $id )->first();

            $subquestion->delete();
            $question->delete();
            return redirect()->back()->with('success','تم حذف السؤالين الأساسي والفرعي بنجاح');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
}
