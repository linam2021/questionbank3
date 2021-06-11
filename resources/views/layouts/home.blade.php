@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <form action="{{ route('addDepartment') }}" method="POST">
    @csrf
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><h2> <b>إضافة مسار جديد </b></h2></div>
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
                            <label class="form-label">اسم المسار</label>
                            <input type="text" class="form-control" name="department_name" value ="{{Session::get('department_name') }}" placeholder="ادخل اسم المسار">
                            @error('department_name')
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
    <div class="col-md-6">
        <div class="card">
            <div class="card-header"><h2> <b>المسارات المضافة</b></h2></div>
                @php
                    $i = 1
                @endphp
                <table class="table table-bordered">
                    <thead>
                    <tr class="table-secondary">
                        <th scope="col">الرقم</th>
                        <th scope="col">اسم المسار</th>
                        <th scope="col">حذف مسار</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $dept)
                            <tr class="table-light">
                                <th scope="row">{{$i}}</th>
                                <td>{{$dept->department_name}}</td>
                                <td class="text-center">
                                    <a class="text-danger" href="{{route('deleteDept',['id'=>$dept->id])}}"> <i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @php
                            $i++
                            @endphp
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center" class="text-secondary">
                    {!! $departments->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
</div>
@endsection
