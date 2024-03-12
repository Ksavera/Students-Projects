<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Project;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $students = Student::all();
        return view("students.index", compact("students"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Student::$categories;
        $locations = Student::$locations;


        return view('students.create', compact('locations', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Student $student)
    {

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'about' => 'required|string',
            'skills' => 'nullable|string',
            'linkedin' => 'required|string',
            'github' => 'required|string',
            'phone' => 'nullable|string',

            'category' => 'nullable|string',
            'location' => 'nullable|string',
            'photo' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ]);
        $file = $request->file('photo');
        $path = $file->store('photos', 'public');

        $student = Student::create([
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'about' => $validatedData['about'],
            'skills' => $validatedData['skills'],
            'linkedin' => $validatedData['linkedin'],
            'github' => $validatedData['github'],
            'phone' => $validatedData['phone'],
            'category' => $validatedData['category'],
            'location' => $validatedData['location'],
            'photo_path' => $path
        ]);


        $successMessage = 'Congratulations, ' . $student->name . '! Your profile was created';
        return redirect()
            ->route("students.show", ['student' => $student])
            ->with('success', $successMessage)
            ->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {

        return view("students.show", ['student' => $student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $categories = Student::$categories;
        $locations = Student::$locations;

        return view('students.create', ['categories' => $categories, 'locations' => $locations, 'student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'about' => 'required|string',
            'skills' => 'nullable|string',
            'linkedin' => 'required|string',
            'github' => 'required|string',
            'phone' => 'nullable|string',

            'category' => 'nullable|string',
            'location' => 'nullable|string',
            'photo' => 'required|file|mimes:jpg,png,jpeg|max:2048'
        ]);
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('photos', 'public');
            $validatedData['photo_path'] = $path;
        }

        // Update the student record
        $student->update($validatedData);

        // Redirect back to the student's profile or index page
        return redirect()->route('students.show', ['student' => $student])
            ->with('success', 'Profile updated successfully')
            ->withInput();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {

        // Delete associated projects
        $student->projects()->delete();

        // Delete the student
        $student->delete();

        return redirect()->route('students.index')->with('success', 'Student and associated records deleted successfully.');
    }
}
