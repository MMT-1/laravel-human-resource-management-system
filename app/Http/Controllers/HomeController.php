<?php

namespace App\Http\Controllers;

use DB;
use PDF;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Holiday;
use App\Models\Trainer;
use App\Models\Employee;
use App\Models\department;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // main dashboard
    public function index()
    {
        $employeeCount = Employee::count();
        $holidays = Holiday::count();
        $departments = department::count();
        $trainers = Trainer::count();
        return view('dashboard.dashboard',compact('employeeCount','holidays','departments','trainers'));
    }
    // employee dashboard
  
    public function generatePDF(Request $request)
    {
       
        $pdf = PDF::loadView('payroll.salaryview');
        // download pdf file
        return $pdf->download('pdfview.pdf');
    }
}
