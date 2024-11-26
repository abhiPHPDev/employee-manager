@extends('layout')

@section('content')
    <div class="d-flex justify-content-end py-4">
        <a href="{{route('employees.index')}}" class="btn btn-primary btn-sm">All Employee</a>
    </div>
    <div class="row  justify-content-center d-flex">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h5>Add Detail</h5>
                </div>
                <form action="{{route('employees.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row py-2">
                            <div class="col-6">                        
                                <label for="first_name">First name</label>
                                <input type="text" id="first_name" name="first_name" class="form-control" required placeholder="Enter first name">
                            </div>
                            <div class="col-6">
                                <label for="last_name">Last name</label>
                                <input type="text" id="last_name" name="last_name" class="form-control" required placeholder="Enter last name">
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="Enter email">
                            </div>
                            <div class="col-6">
                                <label for="mobile">Mobile</label>
                                <div class="d-flex justify-content-between">
                                    <select name="country_code" id="country_code" class="form-control" required>
                                        <option value="">--Choose--</option>
                                        @foreach($countryCodes as $code => $name)
                                            <option value="{{$code}}">{{$name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="text" id="mobile" name="mobile" class="form-control" required placeholder="Enter mobile">
                                </div>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col-6">
                                <label for="photo">Photo</label>
                                <input type="file" id="photo" name="photo" class="form-control" required accept="image/jpeg,image/png">
                            </div>
                            <div class="col-6">
                                <label for="gender">Gender</label>
                                <select name="gender" id="gender" class="form-control" required>
                                    <option value="">--Choose--</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col">
                                <label for="address">Address</label>
                                <textarea id="address" name="address" class="form-control" rows="2" placeholder="Enter address"></textarea>
                            </div>
                        </div>
                        <div class="row py-2">
                            <div class="col">
                                <label for="hobbies">Hobbies</label>
                                <div>
                                    @foreach($hobbies as $key=> $hobby)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" name="hobbies[]" id="hobby{{$loop->iteration}}" value="{{$key}}">
                                            <label class="form-check-label" for="hobby{{$loop->iteration}}">{{$hobby}}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mx-2">Save Detail</button>
                        <a href="{{route('employees.index')}}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>    
            </div>
         </div>
     </div>
@endsection        