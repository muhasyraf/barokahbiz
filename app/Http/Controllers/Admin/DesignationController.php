<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Designation;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Models\Department;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    
    use CsvImportTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Designation::with(['department'])->select(sprintf('%s.*', (new Designation())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'department_show';
                $editGate = 'department_edit';
                $deleteGate = 'department_delete';
                $crudRoutePart = 'designations';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('department_name', function ($row) {
                return $row->department ? $row->department->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'department']);

            return $table->make(true);
        }

        return view('admin.designations.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $designations = Designation::with('department')->get();
        $departments = Department::get();
        return view('admin.designations.create', compact('designations','departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'department' => 'required',

        ]);

        Designation::create([
            'name' => $request->name,
            'department_id'=>$request->department,
        ]);

        return redirect()->route('admin.designations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $designation = Designation::find($id);
        return view('admin.designations.show', ['designation' => $designation]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $designation = Designation::find($id);
        return view('admin.designations.edit', ['designation' => $designation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $designation->update([
            'id' => $request->id,
            'name' => $request->name,
            'department_id'=>$request->department,
        ]);
        
        return redirect()->route('admin.designations.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $designation->delete();
        return redirect()->route('admin.designations.index');
    }
}
