<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::with(['headOfDepartment', 'programs'])->paginate(15);
        return view('admin.departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = User::whereHas('role', function($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('admin.departments.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:10|unique:departments',
            'description' => 'nullable|string|max:1000',
            'head_of_department_id' => 'nullable|exists:users,id',
        ]);

        Department::create([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'head_of_department_id' => $request->head_of_department_id,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Department created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        $department->load(['headOfDepartment', 'programs.courses']);
        return view('admin.departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $teachers = User::whereHas('role', function($query) {
            $query->where('name', 'teacher');
        })->get();

        return view('admin.departments.edit', compact('department', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => ['required', 'string', 'max:10', Rule::unique('departments')->ignore($department->id)],
            'description' => 'nullable|string|max:1000',
            'head_of_department_id' => 'nullable|exists:users,id',
        ]);

        $department->update([
            'name' => $request->name,
            'code' => $request->code,
            'description' => $request->description,
            'head_of_department_id' => $request->head_of_department_id,
        ]);

        return redirect()->route('admin.departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        // Check if department has programs
        if ($department->programs()->count() > 0) {
            return redirect()->route('admin.departments.index')->with('error', 'Cannot delete department with associated programs.');
        }

        $department->delete();
        return redirect()->route('admin.departments.index')->with('success', 'Department deleted successfully.');
    }
}
