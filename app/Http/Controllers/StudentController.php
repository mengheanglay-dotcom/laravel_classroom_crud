<?php
namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $gender = $request->query('gender');
        $students = Student::query()
            ->when($search, fn($q) => $q->where(fn($sub) => $sub->where('name','like',"%{$search}%")->orWhere('email','like',"%{$search}%")->orWhere('phone','like',"%{$search}%")))
            ->when($gender, fn($q) => $q->where('gender', $gender))
            ->latest()->paginate(10)->withQueryString();
        return view('students.index', compact('students','search','gender'));
    }
    public function create() { return view('students.create'); }
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|string|max:255','gender'=>'required|in:male,female,other','email'=>'required|email|max:255|unique:students,email','phone'=>'nullable|string|max:30','address'=>'nullable|string|max:500']);
        Student::create($data);
        return redirect()->route('students.index')->with('success','Student added successfully.');
    }
    public function show(Student $student) { return view('students.show', compact('student')); }
    public function edit(Student $student) { return view('students.edit', compact('student')); }
    public function update(Request $request, Student $student)
    {
        $data = $request->validate(['name'=>'required|string|max:255','gender'=>'required|in:male,female,other','email'=>['required','email','max:255',Rule::unique('students','email')->ignore($student->id)],'phone'=>'nullable|string|max:30','address'=>'nullable|string|max:500']);
        $student->update($data);
        return redirect()->route('students.index')->with('success','Student details updated.');
    }
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success','Student record deleted.');
    }
}
