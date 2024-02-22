@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.employeeAttendance.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.employee-attendances.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="employee">{{ trans('cruds.employee.fields.id') }} - Name</label>
                <select class="form-control select2 {{ $errors->has('employee') ? 'is-invalid' : '' }}" name="employee" id="employee" onchange="attendanceFunction(event)" required>
                    @if(!empty($employees->count()))
                            @foreach($employees as $employee)
                                <option value="{{$employee->id}}">{{$employee->id}} - {{$employee->name}}</option>
                            @endforeach
                            @endif
                </select>
                @if($errors->has('employee'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.id_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="employee_name">{{ trans('cruds.employee.fields.name') }}</label>
                @if(!empty($employees->count()))
                            @foreach($employees as $employee)
                            <input id="employee_name" name="employee_name" type="text" disabled>
                            @endforeach
                            @endif
                @if($errors->has('employee_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employee_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.employeeAttendance.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label>Checkin Time <span class="text-danger">*</span></label>
                <input type="time" name="checkin" class="form-control">
            </div>
            <div class="form-group">
                <label>Checkout Time <span class="text-danger">*</span></label>
                <input name="checkout" class="form-control" type="time">
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
<script>
    function attendanceFunction(e) {
    document.getElementById("employee_name").value = e.target.value
}
</script>
@endsection