@extends('layouts.admin')
@section('content')

<div class="card">

    {{--card header--}}
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('global.role.title_singular') }}
    </div>

    {{--card Body--}}
    <div class="card-body">

        {{--form--}}
        <form action="{{ route("admin.roles.store") }}" method="POST" enctype="multipart/form-data">

            @csrf

            {{--nome e sigla--}}
            <div class="row">

                {{--nome do tipo--}}
                <div class="col-6">

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">

                        <label for="title">{{ trans('global.role.fields.title') }}*</label>

                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}">

                        @if($errors->has('title'))
                            <em class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </em>
                        @endif

                        {{--helper do tipo--}}
                        <p class="helper-block">
                            {{ trans('global.role.fields.title_helper') }}
                        </p>

                    </div>

                </div>

                {{--sigla do tipo--}}
                <div class="col-6">

                    <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">

                        <label for="short_name">{{ trans('global.role.fields.short_name') }}*</label>

                        <input type="text" id="short_name" name="short_name" class="form-control" value="{{ old('short_name', isset($role) ? $role->short_name : '') }}">

                        @if($errors->has('short_name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('short_name') }}
                            </em>
                        @endif

                        {{--helper do tipo--}}
                        <p class="helper-block">
                            {{ trans('global.role.fields.short_name_helper') }}
                        </p>

                    </div>

                </div>

            </div>

            {{--Descrição da função--}}
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">

                <label for="description">{{ trans('global.role.fields.description') }}*</label>

                <textarea id="description" name="description" class="form-control">{{ old('description', isset($role) ? $role->description : '') }}</textarea>

                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif

                {{--helper da descrição--}}
                <p class="helper-block">
                    {{ trans('global.role.fields.description_helper') }}
                </p>

            </div>


            {{--permissões--}}
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">

                <label for="permissions">{{ trans('global.role.fields.permissions') }}*

                    {{--botões--}}
                    <span class="btn btn-info btn-xs select-all">Selecionar Tudo</span>
                    <span class="btn btn-info btn-xs deselect-all">Remover Tudo</span></label>

                <select name="permissions[]" id="permissions" class="form-control select2" multiple="multiple">
                    @foreach($permissions as $id => $permissions)
                        <option value="{{ $id }}" {{ (in_array($id, old('permissions', [])) || isset($role) && $role->permissions->contains($id)) ? 'selected' : '' }}>
                            {{ $permissions }}
                        </option>
                    @endforeach
                </select>

                @if($errors->has('permissions'))
                    <em class="invalid-feedback">
                        {{ $errors->first('permissions') }}
                    </em>
                @endif

                <p class="helper-block">
                    {{ trans('global.role.fields.permissions_helper') }}
                </p>

            </div>

            {{--buttons--}}
            <div>

                {{--cancel--}}
                <a class="btn btn-danger" href="{{ URL::previous() }}">
                    {{ trans('global.cancel') }}
                </a>

                {{---submit--}}
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">

            </div>

        </form>

    </div>

</div>

@endsection
