@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <form action="{{ route('addCourse') }}" method="POST">
        @csrf
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><h2> <b>إضافة دورة جديدة </b></h2></div>
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
                        <div class="col-md-12">
                            <div class="col-md-8 my-2">
                                <label for="exampleFormControlInput1" class="form-label">اسم المسار</label>
                                <select class="form-select" name =department_id aria-label="Default select example">
                                    @foreach ($departments as $department)
                                        @if ($department->id == Session::get('department_id'))
                                            <option selected value="{{$department->id}}">{{$department->department_name}}</option>
                                        @else
                                            <option value="{{$department->id}}">{{$department->department_name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-8 my-2">
                                <label class="form-label">اسم الدورة</label>
                                <input type="text" class="form-control" name="course_name" value ="{{Session::get('course_name') }}" placeholder="ادخل اسم الدورة">
                                @error('course_name')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-8 my-2">
                                <label class="form-label">رابط الدورة</label>
                                <input type="text" class="form-control" name="course_url" value ="{{Session::get('course_url') }}" placeholder="ادخل رابط الدورة">
                                @error('course_url')
                                    <p class="text-danger">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-12 text-center">
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
    </div>
    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2> <b>الدورات المضافة</b></h2></div>
                    @php
                        $i = 1
                    @endphp
                    <table class="table table-bordered">
                        <thead>
                        <tr class="table-secondary text-center">
                            <th scope="col">الرقم</th>
                            <th scope="col">اسم المسار</th>
                            <th scope="col">اسم الدورة</th>
                            <th scope="col">رابط الدورة</th>
                            <th scope="col"><pre>        </pre></th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="table-light">
                                    <th scope="row">{{$i}}</th>
                                    <td>{{$course->department_name}}</td>
                                    <td>{{$course->course_name}}</td>
                                    <td>{{$course->course_url}}</td>
                                    <td class="text-center">
                                        <div class="row" >
                                            <div class="col">
                                                <a  class="text-dark" href="{{route('showQuestions', ['id'=>$course->id])}}"> <i class="fa fa-plus"> </i></a>
                                            </div>
                                            <div class="col">
                                                <a class="text-danger" href="{{route('deleteCourse',['id'=>$course->id])}}" > <i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                $i++
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center" class="text-secondary">
                        {!! $courses->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
