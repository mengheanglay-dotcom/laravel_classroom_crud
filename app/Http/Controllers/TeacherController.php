<?php
namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('search', ''));
        $gender = $request->query('gender');
        $teachers = Teacher::query()
            ->when($search, fn($q) => $q->where(fn($sub) => $sub->where('name','like',"%{$search}%")->orWhere('email','like',"%{$search}%")->orWhere('phone','like',"%{$search}%")))
            ->when($gender, fn($q) => $q->where('gender', $gender))
            ->latest()->paginate(10)->withQueryString();
        return view('teachers.index', compact('teachers','search','gender'));
    }
    public function create() { return view('teachers.create'); }
    public function store(Request $request)
    {
        $data = $request->validate(['name'=>'required|string|max:255','gender'=>'required|in:male,female,other','email'=>'required|email|max:255|unique:teachers,email','phone'=>'nullable|string|max:30','image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048']);
        if ($request->hasFile('image')) $data['image'] = $request->file('image')->store('teachers','public');
        Teacher::create($data);
        return redirect()->route('teachers.index')->with('success','Teacher added successfully.');
    }
    public function show(Teacher $teacher) { return view('teachers.show', compact('teacher')); }
    public function edit(Teacher $teacher) { return view('teachers.edit', compact('teacher')); }
    public function update(Request $request, Teacher $teacher)
    {
        $data = $request->validate(['name'=>'required|string|max:255','gender'=>'required|in:male,female,other','email'=>['required','email','max:255',Rule::unique('teachers','email')->ignore($teacher->id)],'phone'=>'nullable|string|max:30','image'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048']);
        if ($request->hasFile('image')) {
            if ($teacher->image) Storage::disk('public')->delete($teacher->image);
            $data['image'] = $request->file('image')->store('teachers','public');
        }
        $teacher->update($data);
        return redirect()->route('teachers.index')->with('success','Teacher details updated.');
    }
    public function destroy(Teacher $teacher)
    {
        if ($teacher->image) Storage::disk('public')->delete($teacher->image);
        $teacher->delete();
        return redirect()->route('teachers.index')->with('success','Teacher record deleted.');
    }
}
