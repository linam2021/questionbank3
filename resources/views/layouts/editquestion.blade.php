@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <form action="{{ route('update', ['id'=>$question->id,'page'=>$page])}}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2> <b>تعديل السؤالين الرئيسي والفرعي</b></h2></div>
                    @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <p>{{\Session::get('success')}}</p>
                    </div>
                    @endif
                    @if (\Session::has('error'))
                    <div class="alert alert-danger">
                        <p>{{\Session::get('error')}}</p>
                    </div>
                    @endif
                    <br>
                    <div class="container">
                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <label class="form-label">مستوى السؤال</label>
                                <select class="form-select" name =question_level aria-label="Default select example">
                                    @if ($question->question_level=='صعب')
                                        <option value="متوسط">متوسط</option>
                                        <option selected value="صعب">صعب</option>
                                    @else
                                        <option selected value="متوسط">متوسط</option>
                                        <option value="صعب">صعب</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">رقم الفيديو</label>
                                <input type="text" class="form-control" name="video_number" value ="{{$question->video_number}}" >
                                @error('video_number')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="row" style="margin-top:8px">
                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">السؤال الأساسي</label>
                                <textarea class="form-control" name="question_text" rows="2">{{$question->question_text}}</textarea>
                                @error('question_text')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                {{-- <label for="formFile" class="form-label">صورة السؤال الرئيسي</label>
                                <input class="form-control" type="file" name="question_image" value={{URL::asset($question->question_image)}}>
                                @error('question_image')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror --}}
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    الخيارات
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        الخيار
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        الجواب
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    A
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{$question->answer_a}}" name="answer_a">
                                        @error('answer_a')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($question->correct_answer=='A')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="A">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    B
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{$question->answer_b}}" name="answer_b">
                                        @error('answer_b')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($question->correct_answer=='B')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="B">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="B">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    C
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{$question->answer_c}}" name="answer_c">
                                        @error('answer_c')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($question->correct_answer=='C')
                                                <input checked="checked" class="form-check-input" type="radio" name="correct_answer" value="C">
                                            @else
                                                <input class="form-check-input" type="radio" name="correct_answer" value="C">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @error('correct_answer')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>


                            <div class="col-md-6">
                                <label for="exampleFormControlInput1" class="form-label">السؤال الفرعي</label>
                                <textarea class="form-control" name="sub_question_text" rows="2">{{$subquestion->question_text}}</textarea>
                                @error('sub_question_text')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                                {{-- <label for="formFile" class="form-label">صورة السؤال الفرعي</label>
                                <input class="form-control" type="file" name="sub_question_image">
                                @error('sub_question_image')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror --}}
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    الخيارات
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        الخيار
                                    </div>
                                    <div class="col-md-2 mt-3">
                                        الجواب
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    A
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{$subquestion->answer_a}}" name="sub_answer_a">
                                        @error('sub_answer_a')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($subquestion->correct_answer=='A')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="A">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer" value="A">
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    B
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" value ="{{$subquestion->answer_b}}" name="sub_answer_b" >
                                        @error('sub_answer_b')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($subquestion->correct_answer=='B')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="B">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer" value="B">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2 mt-3">
                                    C
                                    </div>
                                    <div class="col-md-8 mt-3">
                                        <input type="text" class="form-control" name="sub_answer_c" value ="{{$subquestion->answer_c}}">
                                        @error('sub_answer_c')
                                            <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="col-md-2 mt-4">
                                        <div class="form-check">
                                            @if ($subquestion->correct_answer=='C')
                                                <input checked="checked" class="form-check-input" type="radio" name="sub_correct_answer" value="C">
                                            @else
                                                <input class="form-check-input" type="radio" name="sub_correct_answer"  value="C">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @error('sub_correct_answer')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <div class="form-group row mb-0 ">
                            <div class="col-md-12 text-center my-2">
                                <button type="submit" class="btn btn-outline-primary">
                                    <a> <i class="fas fa-edit"> </i></a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
