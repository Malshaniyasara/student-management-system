<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class Studentcontroller extends Controller
{
    protected $student;
    public function __construct()
    {
        $this->student = new Student();
    }

public function showData(){
    $response['students'] = $this->student->all();
    return view('pages.student.home')->with($response);
}

  public function saveData(Request $request){
   $request->validate([
       'stu_name' => ['required'],
       'stu_dob' => ['required'],
       'stu_address' => ['required']
   ]);
   $this->student->create($request->all());
   return redirect()->back();
  }

// edit ha delete wala function...wena de eken

  public function deleteData($stu_id){
//    deta tika find kr gnnw 1st
$student = $this->student->find($stu_id);
$student->delete();
return redirect()->back();
  }

  public function editData($stu_id){
    $response['student'] = $this->student->find($stu_id);
    // view ekt deta tika load wnw
    return view('pages.student.edit')->with($response);

  }
  public function updateData(Request $request,$stu_id){
    $student = $this->student->find($stu_id);
    $student->update(array_merge($student->toArray(),$request->toArray()));
    return redirect('student');
  }

}
