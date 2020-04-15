@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">
         {{ trans('global.show') }} {{ trans('global.permission.title_singular') }}
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">

            <tbody>


            {{--nome da permissão--}}
            <tr>

                {{--label--}}
                <th>
                    {{ trans('global.permission.fields.title') }}
                </th>

                {{--nome--}}
                <td>
                    {{ $permission->title }}
                </td>

            </tr>

            {{--natureza da permissão--}}
            <tr>

                {{--label--}}
                <th>
                    {{ trans('global.permission.fields.nature') }}
                </th>

                {{--natureza--}}
                <td>
                    {{ $permission->nature }}
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

@endsection
