@extends('layouts.admin')
@section('content')

<div class="card">

    {{--card header--}}
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.permission.title_singular') }}
    </div>

    {{--card body--}}
    <div class="card-body">
        <form action="{{ route("admin.permissions.update", [$permission->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{--nome da permissão--}}
            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                <label for="title">{{ trans('global.permission.fields.title') }}*</label>

                <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($permission) ? $permission->title : '') }}">
                @if($errors->has('title'))
                    <em class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.permission.fields.title_helper') }}
                </p>
            </div>

            {{--tipo de permissão--}}
            <div class="form-group {{ $errors->has('nature') ? 'has-error' : '' }}">

                <label for="nature">{{ trans('global.permission.fields.nature') }}*</label>

                <input type="text" id="nature" name="nature" class="form-control" value="{{ old('nature', isset($permission) ? $permission->nature : '') }}">
                @if($errors->has('nature'))
                    <em class="invalid-feedback">
                        {{ $errors->first('nature') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.permission.fields.nature_helper') }}
                </p>

            </div>

            {{--buttons--}}
            <div>

                {{--cancel--}}
                <a class="btn btn-danger" href="{{ URL::previous() }}">
                    {{ trans('global.cancel') }}
                </a>

                {{--submit--}}
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">

            </div>

        </form>

    </div>

</div>

@endsection
