@extends('layout')

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ \session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="d-flex justify-content-end py-3">
            <a href="{{route('employees.create')}}" class="btn btn-primary btn-sm">Create New Employee</a>
        </div>
        <div class="card">
            <div class="card-header">
                <h5>All Employees</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Gender</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($employees->isNotEmpty())
                                @foreach($employees as $employ)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$employ->first_name}} {{$employ->last_name}}</td>
                                        <td>{{$employ->email}}</td>
                                        <td>{{$employ->country_code}} {{$employ->mobile}}</td>
                                        <td>{{ucfirst($employ->gender)}}</td>
                                        <td>
                                             <a href="{{route('employees.edit', $employ->id)}}" class="btn btn-sm btn-primary">Edit</a>
                                             <form action="{{route('employees.destroy', $employ->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this employee?')">
                                                 @csrf
                                                 @method('DELETE')
                                                 <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                             </form> 
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr>
                                <td colspan="6" align="center" class="fw-bold text-danger">no record found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection