@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.vendor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.vendors.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="id_vendor">{{ trans('cruds.vendor.fields.id_vendor') }}</label>
                <input class="form-control {{ $errors->has('id_vendor') ? 'is-invalid' : '' }}" type="number" name="id_vendor" id="id_vendor" value="{{ old('id_vendor', '4') }}" step="1">
                @if($errors->has('id_vendor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('id_vendor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.id_vendor_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="nama_vendor">{{ trans('cruds.vendor.fields.nama_vendor') }}</label>
                <input class="form-control {{ $errors->has('nama_vendor') ? 'is-invalid' : '' }}" type="text" name="nama_vendor" id="nama_vendor" value="{{ old('nama_vendor', '') }}" required>
                @if($errors->has('nama_vendor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nama_vendor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.nama_vendor_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="telepon">{{ trans('cruds.vendor.fields.telepon') }}</label>
                <input class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" type="text" name="telepon" id="telepon" value="{{ old('telepon', '') }}">
                @if($errors->has('telepon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telepon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.telepon_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.vendor.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', '') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alamat">{{ trans('cruds.vendor.fields.alamat') }}</label>
                <input class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" type="text" name="alamat" id="alamat" value="{{ old('alamat', '') }}">
                @if($errors->has('alamat'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alamat') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.alamat_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.vendor.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.vendor.fields.website_helper') }}</span>
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