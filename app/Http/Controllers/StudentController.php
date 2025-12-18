<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mccarlosen\LaravelMpdf\Facades\LaravelMpdf as PDF;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        return view('students.index', compact('students'));
    }


    public function create()
    {
        $isViewOnly = false;
        return view('students.create', compact('isViewOnly'));
    }


    public function store(Request $request)
    {
        try {
            Log::info('Store Request Received:', ['request' => $request->all()]);
            $validatedData = $request->validate([
                'seat_number' => 'required|unique:students|max:255',
                'student_name' => 'required|max:255',
                'grades' => 'required|array',
                'passed_subjects' => 'required|integer',
                'failed_subjects' => 'required|integer',
                'total' => 'required|integer',
                'overall_average' => 'required|numeric',
                'overall_averagee' => 'required|numeric',
                'grade' => 'required|string|max:50',
                'academic_year' => 'required|string|max:50',
            ]);
            $student = Student::create($validatedData);
            Log::info('Student Created Successfully:', ['student' => $student]);


            $hashedId = Crypt::encrypt($student->id);
            return redirect()->route('students.certificate', ['hashedId' => $hashedId]);
        } catch (\Exception $e) {
            Log::error('Error in store method:', ['message' => $e->getMessage()]);
            return redirect()->back()->withErrors('An error occurred while saving the record.');
        }
    }
    public function show($hashedId)
{
    try {
        $id = Crypt::decrypt($hashedId);
        $student = Student::findOrFail($id);
        $qrData = route('students.show', ['hashedId' => $hashedId]);
        $qrCode = QrCode::size(150)->generate($qrData);
        $isViewOnly = true;

        // Return the new view with student data
        return view('students.show', compact('student', 'qrCode', 'hashedId', 'isViewOnly'));
    } catch (\Exception $e) {
        Log::error('Error in show method:', [
            'message' => $e->getMessage(),
            'hashedId' => $hashedId
        ]);
        return redirect()->back()->withErrors('An error occurred while retrieving the record.');
    }
}

    public function edit(string $id)
    {
        $student = Student::findOrFail($id);
        $isViewOnly = false;
        return view('students.edit', compact('student', 'isViewOnly'));
    }
    public function update(Request $request, Student $student, $id)
    {
        try {
            Log::info('Update Request Received:', ['student_id' => $id]);
            $student = Student::findOrFail($id);

            $data = $request->validate([
                'seat_number' => 'required|max:255|unique:students,seat_number,' . $id,
                'student_name' => 'required|max:255',
                'grades' => 'required|array',
                'passed_subjects' => 'required|integer',
                'failed_subjects' => 'required|integer',
                'total' => 'required|integer',
                'overall_average' => 'nullable|numeric',
                'overall_averagee' => 'nullable|numeric',
                'grade' => 'required|string|max:50',
                'academic_year' => 'required|string|max:50',
            ]);

            Log::info('Validated Data:', ['data' => $data]);

            $student->update($data);

            Log::info('Student updated successfully', ['student_id' => $id]);

            return redirect()->route('students.index')->with('success', 'تم تحديث بيانات الطالب بنجاح');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error:', ['errors' => $e->errors()]);

            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Log::error('Error in update method:', ['message' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            return redirect()->back()->withErrors('An error occurred while updating the record.');
        }
    }


    public function destroy(Student $student, $id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $students = Student::where('seat_number', 'like', "%{$query}%")
            ->orWhere('student_name', 'like', "%{$query}%")
            ->get()
            ->map(function ($student) {
                $student->hashedId = Crypt::encrypt($student->id);
                return $student;
            });

        return response()->json($students);
    }

    public function certificate($hashedId)
    {
        try {
            $id = Crypt::decrypt($hashedId);
            $student = Student::findOrFail($id);
            $qrData = route('students.show', ['hashedId' => $hashedId]);
            $qrCode = QrCode::size(150)->generate($qrData);

            return view('students.certificate', compact('student', 'qrCode', 'hashedId'));
        } catch (\Exception $e) {
            Log::error('Error in certificate method:', [
                'message' => $e->getMessage(),
                'hashedId' => $hashedId
            ]);
            return redirect()->route('students.create')->withErrors('An error occurred while retrieving the certificate.');
        }
    }

    public function certificationForm()
    {
        return view('students.certification-form');
    }


    public function showCertification(Request $request)
    {
        $validated = $request->validate([
            'seat_number' => 'nullable|string',
            'registration_number' => 'nullable|string',
        ]);
    
        if (!empty($validated['seat_number'])) {
            $student = Student::where('seat_number', $validated['seat_number'])->first();
    
            if (!$student) {
                return redirect()->back()->withErrors(['seat_number' => 'لا يوجد طالب برقم الجلوس هذا']);
            }
    
            $hashedId = Crypt::encrypt($student->id);
            $qrData = route('students.show', ['hashedId' => $hashedId]);
            $qrCode = QrCode::size(150)->generate($qrData);
            $isViewOnly = true;
    
            return redirect()->route('students.show', compact('student', 'qrCode', 'hashedId', 'isViewOnly'));
        }
    
        // If registration number is provided, always return the error
        if (!empty($validated['registration_number'])) {
            return redirect()->back()->withErrors(['registration_number' => 'لا يوجد طالب برقم القيد هذا']);
        }
    
        // If neither is provided, return an error
        return redirect()->back()->withErrors(['general' => 'يرجى إدخال رقم الجلوس أو رقم القيد']);
    }
    
}
