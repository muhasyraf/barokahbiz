@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.purchaseInq.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.purchase-inqs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_purchase_inquiry">{{ trans('cruds.purchaseInq.fields.id_purchase_inquiry') }}</label>
                <input class="form-control {{ $errors->has('id_purchase_inquiry') ? 'is-invalid' : '' }}" type="text" name="id_purchase_inquiry" id="id_purchase_inquiry" value="{{ old('id_purchase_inquiry', '') }}">
                @if($errors->has('id_purchase_inquiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_purchase_inquiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.id_purchase_inquiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="id_request_for_quotation_id">{{ trans('cruds.purchaseInq.fields.id_request_for_quotation') }}</label>
                <select class="form-control select2 {{ $errors->has('id_request_for_quotation') ? 'is-invalid' : '' }}" name="id_request_for_quotation_id" id="id_request_for_quotation_id">
                    @foreach($id_request_for_quotations as $id => $entry)
                        <option value="{{ $id }}" {{ old('id_request_for_quotation_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('id_request_for_quotation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_request_for_quotation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.id_request_for_quotation_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="vendor_name_id">{{ trans('cruds.purchaseInq.fields.vendor_name') }}</label>
                <select class="form-control select2 {{ $errors->has('vendor_name') ? 'is-invalid' : '' }}" name="vendor_name_id" id="vendor_name_id">
                    @foreach($vendor_names as $id => $entry)
                        <option value="{{ $id }}" {{ old('vendor_name_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('vendor_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('vendor_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.vendor_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="date_puchase_inquiry">{{ trans('cruds.purchaseInq.fields.date_puchase_inquiry') }}</label>
                <input class="form-control date {{ $errors->has('date_puchase_inquiry') ? 'is-invalid' : '' }}" type="text" name="date_puchase_inquiry" id="date_puchase_inquiry" value="{{ old('date_puchase_inquiry') }}">
                @if($errors->has('date_puchase_inquiry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('date_puchase_inquiry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.date_puchase_inquiry_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_material_id">{{ trans('cruds.purchaseInq.fields.name_material') }}</label>
                <select class="form-control select2 {{ $errors->has('name_material') ? 'is-invalid' : '' }}" name="name_material_id" id="name_material_id">
                    @foreach($name_materials as $id => $entry)
                        <option value="{{ $id }}" {{ old('name_material_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('name_material'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_material') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.name_material_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="qty">{{ trans('cruds.purchaseInq.fields.qty') }}</label>
                <input class="form-control {{ $errors->has('qty') ? 'is-invalid' : '' }}" type="number" name="qty" id="qty" value="{{ old('qty', '') }}" step="1">
                @if($errors->has('qty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('qty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.purchaseInq.fields.qty_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection