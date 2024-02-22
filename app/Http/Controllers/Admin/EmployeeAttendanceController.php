<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use App\Http\Controllers\Traits\CsvImportTrait;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;
use App\Settings\AttendanceSettings;
use App\Models\Employee;

class EmployeeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $query = EmployeeAttendance::with(['department'])->select(sprintf('%s.*', (new Designation())->table));
            $table = Datatables::of(EmployeeAttendance::all());

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'department_show';
                $editGate = 'department_edit';
                $deleteGate = 'department_delete';
                $crudRoutePart = 'employee-attendances';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('employee_id', function ($row) {
                return $row->employee ? $row->employee->id : '';
            });
            $table->editColumn('employee_name', function ($row) {
                return $row->employee ? $row->employee->name : '';
            });
            $table->editColumn('checkin', function ($row) {
                return $row->checkin ? $row->checkin : '';
            });
            $table->editColumn('checkout', function ($row) {
                return $row->checkout ? $row->checkout : '';
            });
            $table->editColumn('date', function ($row) {
                return $row->date ? $row->status : '';
            });
            $table->editColumn('status', function ($row) {
                return $row->status ? $row->status : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'employee']);

            return $table->make(true);
        }

        return view('admin.employeeAttendances.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::get();
        return view('admin.employeeAttendances.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'employee' => 'required',
            'checkin' => 'required',
        ]);
        $settings = new AttendanceSettings();
        $time = date('H:i');
        $min_checkin_time = strtotime($settings->checkin_time) + 1800;
        if($request->checkin){
            if($time < $settings->checkin_time){
                $status = 'early';
            }if($time <= date('H:i',$min_checkin_time)){
                $status = 'ontime';
            }else{
                $status = 'late';
            }
        }
            
        EmployeeAttendance::create([
            'employee_id' => $request->employee,
            'name' => $request->employee_name,
            'checkin' => $request->checkin,
            'checkout' => $request->checkout,
            'status' => $status,
        ]);
        return redirect()->route('admin.employeeAttendances.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeAttendance  $employeeAttendance
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employeeAttendance = EmployeeAttendance::find($id);
        return view('admin.employees.show', ['employeeAttendance' => $employeeAttendance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeAttendance  $employeeAttendance
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeAttendance $employeeAttendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeAttendance  $employeeAttendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeAttendance $employeeAttendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeAttendance  $employeeAttendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeAttendance $employeeAttendance)
    {
        //
    }
}
