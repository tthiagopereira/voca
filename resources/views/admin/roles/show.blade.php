@extends('layouts.admin')
@section('content')

    {{--exibe informações sobre a função--}}
    <div class="card">

        {{--card header--}}
        <div class="card-header">
            {{ trans('global.show') }} {{ trans('global.role.title') }}
        </div>

        {{--card-body--}}
        <div class="card-body">

            <table class="table table-bordered table-striped">

                <tbody>

                {{--nome da função--}}
                <tr>
                    <th>
                        {{ trans('global.role.fields.title_show') }}
                    </th>
                    <td>
                        {{ $role->title }}
                    </td>
                </tr>

                {{--sigla--}}
                <tr>

                    {{--label--}}
                    <th>
                        {{ trans('global.role.fields.short_name_show') }}
                    </th>

                    {{--sigla--}}
                    <td>
                        {{ $role->short_name }}
                    </td>
                </tr>

                {{--se existir descrição, será mostrado--}}
                @if($role->description)
                {{--descrição da função--}}
                <tr>

                    {{--label--}}
                    <th>
                        {{ trans('global.role.fields.description_show') }}
                    </th>

                    {{--descricao--}}
                    <td>
                        {{ $role->description }}
                    </td>
                </tr>
                @endif

                {{--permissões--}}
                <tr>
                    {{--label--}}
                    <th>
                        {{ trans('global.permissions') }}
                    </th>

                    {{--permissões da função--}}
                    <td>
                        @foreach($role->permissions as $id => $permissions)
                            <span class="badge badge-info">{{ $permissions->title }}</span>
                        @endforeach
                    </td>

                </tr>

                </tbody>

            </table>

            {{--voltar--}}
            <a class="btn btn-outline-dark" href="{{ URL::previous() }}">
                {{ trans('global.back') }}
            </a>

        </div>

    </div>

    {{--mostra quem está cadastrado com essa função--}}
    <div class="card">
        <div class="card-header">
            Usuários com esta função
        </div>
        <div class="card-body">
            lista
            <br>
            (Em construção)
        </div>
    </div>

@endsection
