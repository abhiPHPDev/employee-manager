<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Iluminate\Support\Facades\Storage;
class EmployeeController extends Controller
{
    //
    private $countryCode = array();
    private $hobbies = array();

    public function __construct(){
        $this->countryCode = array(
            '+1' => '+1',
            '+91' => '+91',
            '+971'=>'+971', 
        );

        $this->hobbies = array(
            'Reading' => 'Reading',
            'Writing' => 'Writing',
            'Playing Games' => 'Playing Games',
            'Cooking' => 'Cooking',
            'Gardening' => 'Gardening',
            'Hiking' => 'Hiking',
            'Painting' => 'Painting',
            'Photography' => 'Photography',
            'Traveling' => 'Traveling',
        );
    }

    public function index(){
        $employees = Employee::orderBy('id','desc')->paginate(10);
        return view('employee.index', compact('employees'));
    }

    public function create(){
        $hobbies = $this->hobbies;
        $countryCodes = $this->countryCode;
        return view('employee.create', compact('countryCodes', 'hobbies'));
    }

    public function store(Request $request){
        $request->validate([
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'required|unique:employees,email',
            'country_code'=>'required',
            'mobile'=>'required|numeric',
            'photo'=>'required|image|mimes:jpeg,jpg,png',
            'gender'=>'required'
        ]);
        
        $file = $request->file('photo');
        $fileName = time().'-'.$file->getClientOriginalName();
        $file->move(public_path('uploads'),$fileName);
        $photo = 'uploads/'.$fileName;

        //Insert in employee table
        Employee::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'email'=>$request->email,
            'country_code'=>$request->country_code,
           'mobile'=>$request->mobile,
            'photo'=>$photo,
            'gender'=>$request->gender,
            'hobbies'=>json_encode($request->hobbies),
            'address'=>$request->address
        ]);
        return redirect()->route('employees.index')->with('success', 'Employee created successfully');
    }

    public function edit($id){
        $employee = Employee::findOrFail($id);
        $selectedHobbies = json_decode($employee->hobbies,true);
        $hobbies = $this->hobbies;

        $countryCodes = $this->countryCode;
        return view('employee.edit', compact('employee', 'countryCodes', 'hobbies','selectedHobbies'));
    }


    public function update(Request $request, $id){
        $validator = $request->validate([
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'email'=>'required|unique:employees,email,'.$id,
            'country_code'=>'required',
            'mobile'=>'required|numeric',
            // 'photo'=>'required|image|mimes:jpeg,jpg,png',
            'gender'=>'required'
        ]);
       
            $employee = Employee::findOrFail($id);


            if($request->hasFile('photo')){
    
                $file = $request->file('photo');
                $fileName = time().'-'.$file->getClientOriginalName();
                $file->move(public_path('uploads'),$fileName);
                $photo = 'uploads/'.$fileName;
            }else{
                $photo = $employee->photo;
            }        
    
            $employee->update([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'email'=>$request->email,
                'country_code'=>$request->country_code,
               'mobile'=>$request->mobile,
                'photo'=>$photo,
                'gender'=>$request->gender,
                'hobbies'=>json_encode($request->hobbies),
                'address'=>$request->address
            ]);
    
            return redirect()->route('employees.index')->with('success', 'Employee update successfully');
        
        

    }

    public function destroy($id){
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully');
    }
}
