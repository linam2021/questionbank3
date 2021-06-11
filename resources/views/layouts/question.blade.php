@extends('layouts.app')

@section('content')

<div class="row justify-content-center">

    <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2> <b>إضافة سؤالين رئيسي وفرعي</b></h2></div>
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
                            <div>
                                <label for="exampleFormControlInput1" class="form-label">اسم المسار</label>
                                <input type="text" class="form-control" value = "{{$course->department_name}}" name="course_name" readonly>
                                <input type="hidden" class="form-control" value = "{{$course->id}}" name="course_id" >
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:8px">
                        <div class="col-md-6">
                            <label class="form-label">اسم الدورة</label>
                            <input type="text" class="form-control" value = "{{$course->course_name}}" name="course_name" readonly>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">رابط الدورة</label>
                            <input type="text" class="form-control" value = "{{$course->course_url}}" name="course_url" readonly>
                        </div>
                    </div>

                    <div class="row" style="margin-top:8px">
                        <div class="col-md-6">
                            <label class="form-label">مستوى السؤال</label>
                            <select class="form-select" name =question_level aria-label="Default select example">
                                @if (Session::get('question_level')=='صعب')
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
                            <input type="text" class="form-control" name="video_number" value ="{{Session::get('video_number') }}" placeholder="رقم الفيديو">
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
                            <textarea class="form-control" name="question_text" placeholder="نص السؤال الأساسي" rows="2">{{Session::get('question_text') }}</textarea>
                            @error('question_text')
                                <p class="text-danger">{{$message}}</p>
                            @enderror
                            {{-- <label for="formFile" class="form-label">صورة السؤال الرئيسي</label>
                            <input class="form-control" type="file" name="question_image">
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
                                    <input type="text" class="form-control" value ="{{Session::get('answer_a') }}" name="answer_a" placeholder="نص الخيار A">
                                    @error('answer_a')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('correct_answer')=='A')
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
                                    <input type="text" class="form-control" value ="{{Session::get('answer_b') }}" name="answer_b" placeholder="نص الخيار B">
                                    @error('answer_b')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('correct_answer')=='B')
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
                                    <input type="text" class="form-control" value ="{{Session::get('answer_c') }}" name="answer_c" placeholder="نص الخيار C">
                                    @error('answer_c')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('correct_answer')=='C')
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
                            <textarea class="form-control" name="sub_question_text" placeholder="نص السؤال الفرعي" rows="2">{{Session::get('sub_question_text') }}</textarea>
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
                                    <input type="text" class="form-control" value ="{{Session::get('sub_answer_a') }}" name="sub_answer_a" placeholder="نص الخيار A">
                                    @error('sub_answer_a')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('sub_correct_answer')=='A')
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
                                    <input type="text" class="form-control" value ="{{Session::get('sub_answer_b') }}" name="sub_answer_b" placeholder="نص الخيار B">
                                    @error('sub_answer_b')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('sub_correct_answer')=='B')
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
                                    <input type="text" class="form-control" name="sub_answer_c" value ="{{Session::get('sub_answer_c') }}" placeholder="نص الخيار C">
                                    @error('sub_answer_c')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                </div>
                                <div class="col-md-2 mt-4">
                                    <div class="form-check">
                                        @if (Session::get('sub_correct_answer')=='C')
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
                            <button type="submit" class="btn btn-outline-dark">
                                <a> <i class="fa fa-plus"> </i></a>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</form>
<br>
<br>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header"><h2> <b>الأسئلة المضافة</b></h2></div>
            @if ($questions->count()>0)
                @php
                    $i = 1 + ($questions->currentpage()-1)*5
                @endphp
                <table class="table table-secondary table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">الرقم</th>
                                <th scope="col">اسم المستخدم</th>
                                <th scope="col">نص السؤال </th>
                                {{-- <th scope="col">رابط الصورة</th> --}}
                                <th scope="col">الإجابة A</th>
                                <th scope="col">الإجابة B</th>
                                <th scope="col">الإجابة C</th>
                                <th scope="col">الإجابة الصحيحة</th>
                                <th scope="col">رقم الفيديو</th>
                                <th scope="col">مستوى السؤال</th>
                                <th scope="col" class="text-secondary"><pre>        </pre></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                            @if ($loop->odd)
                                @if ($i%2==0)
                                    <tr class="table-info">
                                @else
                                    <tr class="table-light">
                                @endif
                                        <th scope="row">{{$i}}-A </th>
                                        <td scope="row">{{$question->user->name}}</td>
                                        <td scope="row">{{$question->question_text}}</td>
                                        {{-- @if ($question->question_image !=null)
                                            <th class="text-center" scope="row"><a href="{{URL::asset($question->question_image)}}" class="link-primary">Link</a></th>
                                        @else
                                            <th scope="row"></th>
                                        @endif --}}
                                        <td scope="row">{{$question->answer_a}}</td>
                                        <td scope="row">{{$question->answer_b}}</td>
                                        <td scope="row">{{$question->answer_c}}</td>
                                        <td scope="row">{{$question->correct_answer}}</td>
                                        <td scope="row">{{$question->video_number}}</td>
                                        <td scope="row">{{$question->question_level}}</td>
                                        <td class="text-center">
                                            <div class="row" >
                                                <div class="col">
                                                    <a href="{{route('edit', ['id'=>$question->id,'page'=>$questions->currentpage()])}}" > <i class="fas fa-edit"></i></a>
                                                </div>
                                                <div class="col">
                                                    <a class="text-danger" href="{{route('delete',['id'=>$question->id])}}" > <i class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                            @else
                                @if ($i%2==0)
                                    <tr class="table-info">
                                @else
                                    <tr class="table-light">
                                @endif
                                        <td scope="row">{{$i}}-B </td>
                                        <td scope="row">{{$question->user->name}}</td>
                                        <td scope="row">{{$question->question_text}}</td>
                                        {{-- @if ($question->question_image !=null)
                                            <th scope="row" class="text-center"><a href="{{URL::asset($question->question_image)}}" class="link-primary">Link</a></th>
                                        @else
                                            <th scope="row"></th>
                                        @endif --}}
                                        <td scope="row">{{$question->answer_a}}</td>
                                        <td scope="row">{{$question->answer_b}}</td>
                                        <td scope="row">{{$question->answer_c}}</td>
                                        <td scope="row">{{$question->correct_answer}}</td>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                        <td scope="row"></td>
                                </tr>
                            @php
                            $i++
                            @endphp
                            @endif
                        @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-center" class="text-secondary">
                        {!! $questions->links() !!}
                    </div>
                </div>
                @else
                    <div class="alert alert-info">
                        <p>لا يوجد أسئلة مضافة ضمن هذه الدورة</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
