@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><i class="fa fa-check-circle"></i> <span class="audiowide"> Gerenciamento Selecionados ( PCS ) </span> <i
                class="fa fa-check-circle"></i></h2>
    </div>

    {{--lista de numeros dispensados--}}
    <div class="card">

        {{--card header--}}
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('global.selected') }}
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class="table table-bordered table-striped table-hover datatable">

                    {{--thead--}}
                    <thead>

                    <tr>

                        </th>

                        {{--numero--}}
                        <th class="text-center">
                            {{ trans('global.number.fields.name') }}
                        </th>

                    </tr>

                    </thead>

                    {{--tbody--}}
                    <tbody>
                    @foreach($numbers as $key => $number)

                        <tr data-entry-id="{{ $number->id }}">

                            {{--number--}}
                            <td class="text-center">
                                {{ $number->number }}
                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@section('scripts')
    @parent

    <script>

        // converte a data pro padrao br
        function dataHoraPtBr(data) {

            var aux = data.split('-');

            var tirahora = aux[2].split(' ');

            var hora = data.split(' ')[1];

            data = tirahora[0] + ' / ' + aux[1] + ' / ' + aux[0] + ' ( ' + hora + ' ) ';

            return data;

        }

        // datatables
        $(function () {

            $('.datatable:not(.ajaxTable)').DataTable({
                order: [[0, "asc"]],

                columnDefs: [{
                    orderable: false,
                }, {
                    orderable: false,
                    searchable: true,
                }]

            })

        });

    </script>

@endsection
@endsection
