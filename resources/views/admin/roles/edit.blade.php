@extends('layouts.admin')
@section('content')

<div class="card">

    {{--card header--}}
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('global.role.title_singular') }}
    </div>

    {{--card body--}}
    <div class="card-body">

        {{--form--}}
        <form action="{{ route("admin.roles.update", [$role->id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{--nome e sigla da função--}}
            <div class="row">

                {{--nome da função--}}
                <div class="col-6">

                    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                        <label for="title">{{ trans('global.role.fields.title') }}*</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title', isset($role) ? $role->title : '') }}">
                        @if($errors->has('title'))
                            <em class="invalid-feedback">
                                {{ $errors->first('title') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.role.fields.title_helper') }}
                        </p>
                    </div>

                </div>

                {{--sigla da função--}}
                <div class="col-6">

                    <div class="form-group {{ $errors->has('short_name') ? 'has-error' : '' }}">
                        <label for="short_name">{{ trans('global.role.fields.short_name') }}*</label>
                        <input type="text" id="short_name" name="short_name" class="form-control" value="{{ old('short_name', isset($role) ? $role->short_name : '') }}">
                        @if($errors->has('short_name'))
                            <em class="invalid-feedback">
                                {{ $errors->first('short_name') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.role.fields.short_name_helper') }}
                        </p>
                    </div>

                </div>

            </div>

            {{--descrição--}}
            <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">

                <label for="description">{{ trans('global.role.fields.description') }}*</label>
                <textarea type="text" id="description" name="description" class="form-control">{{ old('description', isset($role) ? $role->description : '') }}</textarea>
                @if($errors->has('description'))
                    <em class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </em>
                @endif
                <p class="helper-block">
                    {{ trans('global.role.fields.description_helper') }}
                </p>

            </div>

            {{--permissões--}}
            <div class="form-group {{ $errors->has('permissions') ? 'has-error' : '' }}">
                <label for="permissions">{{ trans('global.role.fields.permissions') }}*

                    {{--seleciona e remove todas as permissoes--}}
                    <span class="btn btn-info btn-xs select-all">Selecionar todas</span>
                    <span class="btn btn-info btn-xs deselect-all">Remover Todas</span></label>
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

                {{--submit--}}
                <input class="btn btn-success" type="submit" value="{{ trans('global.save') }}">

            </div>

        </form>

    </div>

</div>

@endsection
