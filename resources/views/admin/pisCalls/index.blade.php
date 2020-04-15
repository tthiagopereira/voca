@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><i class="fa fa-user-md"></i> <span class="audiowide"> Gerenciamento de Chamadas ( PIS ) </span> <i
                class="fa fa-user-md"></i></h2>
    </div>

    @can('Pode chamar número PIS')
        {{--número sugerido--}}
        <div class="alert alert-dark bg-black text-center">
            <h2>Número sugerido</h2>

            <div class="row">

                <div class="col-4"></div>

                <div class="col-4">
                    <div class="alert alert-info text-center">

                        @if($sugested_number_object->count() != 0)
                            @foreach($sugested_number_object as $sno)
                                <h1><span class="blink" id="sugested_number">{{ $sno->number }}</span></h1>
                                <button class="btn btn-info btn_chamador" id="chamar_{{ $sno->id }}">Chamar <i
                                        class="fa fa-microphone"></i></button>
                            @endforeach
                        @else

                            <h1><span class="blink">Não existem números disponíveis!</span><h1>

                        @endif

                    </div>

                </div>

                <div class="col-4"></div>

            </div>

        </div>
    @endcan

    {{--números em atendimento--}}
    <div class="alert alert-primary bg-black text-center">
        <h2 id="head_number">Números em atendimento</h2>

        @if($numbers_in->count() != 0)

            @foreach($numbers_in as $ni)

                <div class="alert alert-info text-left pb-0" id="base_{{ $ni->id }}">
                    <div class="row">

                        {{--numero--}}
                        <div class="col">

                            <div class="alert alert-danger text-center">
                                <h2>{{ $ni->number }}</h2>

                            </div>

                        </div>

                        {{--actions--}}
                        @canany(['Pode aprovar / reprovar números PIS','Pode excluir números PIS'])
                            <div class="col">

                                <div class="alert alert-danger text-center">

                                    @can('Pode chamar número PIS')
                                        {{--rechamar--}}
                                        <button type="submit" class="btn btn-success btn-lg btn_recall"
                                                id="recall_{{$ni->id}}">
                                            {{ trans('global.recall') }} <i class="fas fa-sync-alt"></i>
                                        </button>
                                    @endcan

                                    @can('Pode aprovar / reprovar números PIS')
                                        {{--aprovar--}}
                                        <button type="submit" class="btn btn-primary btn-lg btn_aprovador"
                                                id="aprovador_{{$ni->id}}">
                                            {{ trans('global.approve') }} <i class="fa fa-thumbs-o-up"></i>
                                        </button>

                                        {{--reprovar--}}
                                        <button type="submit" class="btn btn-danger btn-lg btn_reprovador"
                                                id="reprovador_{{$ni->id}}">
                                            {{ trans('global.reprove') }} <i class="fa fa-thumbs-o-down"></i>
                                        </button>

                                    @endcan

                                    {{--excluir--}}
                                    @can('Pode excluir números PIS')
                                        <button type="submit" class="btn btn-warning btn-lg btn_excluidor"
                                                id="excluidor_{{$ni->id}}">
                                            {{ trans('global.delete') }} <i class="fa fa-trash"></i>
                                        </button>

                                    @endcan

                                </div>

                            </div>

                        @endcanany

                    </div>

                </div>

            @endforeach

        @else

            <span id="not_number">Não existem números em atendimento</span>

        @endif

    </div>

    {{--lista de numeros cadastrados--}}
    <div class="card">

        {{--card header--}}
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('global.number.title') }}
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

                        {{--acoes--}}
                        <th class="text-center">
                            {{ trans('global.actions') }}
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

                            {{--actions--}}
                            <td class="text-center">

                                {{--chamar número--}}
                                @can('Pode chamar número PIS')

                                    <button type="button" class="btn btn-xs btn-primary btn_chamador"
                                            title="{{ trans('global.view') }}" id="number_{{$number->id}}">
                                        <i class="fa fa-microphone"></i>
                                    </button>
                                @endcan

                                @cannot('Pode chamar número PIS')
                                    <button type="button" class="btn btn-xs btn-light disabled"
                                            title="{{ trans('global.not_allowed') }}">
                                        <i class="fa fa-microphone"></i>
                                    </button>
                                @endcannot

                                {{--excluir numero--}}
                                @can('Pode excluir números PIS')
                                    <button type="submit" class="btn btn-xs btn-danger btn_excluidor"
                                            id="excluidorLista_{{$number->id}}" title="{{ trans('global.delete') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endcan

                                @cannot('Pode excluir números PIS')
                                    <button type="button" class="btn btn-xs btn-light disabled"
                                            title="{{ trans('global.not_allowed') }}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                @endcannot

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{--base para atendimentos--}}
    <div class="alert alert-info text-left pb-0 escondido" id="base_">
        <div class="row">

            {{--numero--}}
            <div class="col-6">

                <div class="alert alert-danger text-center">
                    <h2><span class="nu_number">NUMBER</span></h2>

                </div>

            </div>

            {{--actions--}}
            <div class="col-6">

                <div class="alert alert-danger text-center">

                    {{--rechamar--}}
                    <button type="submit" class="btn btn-success btn-lg btn_recall" id="recall_">
                        {{ trans('global.recall') }} <i class="fa fa-recycle"></i>
                    </button>

                    {{--aprovar--}}
                    <button type="submit" class="btn btn-primary btn-lg btn_aprovador" id="aprovador_">
                        {{ trans('global.approve') }} <i class="fa fa-thumbs-o-up"></i>
                    </button>

                    {{--reprovar--}}
                    <button type="submit" class="btn btn-danger btn-lg btn_reprovador" id="reprovador_">
                        {{ trans('global.reprove') }} <i class="fa fa-thumbs-o-down"></i>
                    </button>

                    {{--excluir--}}
                    @can('Pode excluir números')
                        <button type="submit" class="btn btn-warning btn-lg btn_excluidor" id="excluidor_">
                            {{ trans('global.delete') }} <i class="fa fa-trash"></i>
                        </button>

                    @endcan

                </div>

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

            //let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

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

        // chama um numero
        $(document).on('click', '.btn_chamador', function (e) {

            e.preventDefault();

            // ao chamar um número, muda-se o numero sugerido a ser chamado
            // o numero chamado passa a fazer parte dos numeros em atendimento

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/piscalls/call/' + id,

                success: function (data) {

                    // aqui estoura um erro pois o número ja foi chamado por outra pessoa
                    if (data[0] == 'error_called_number') {

                        // alert de erro
                        toastr.error('Não foi possível realizar a chamada, o número já foi chamado por outra pessoa. Por favor atualize a tela e tente novamente!', 'Falha!', {timeOut: 3000});

                    }
                    // nesse caso posso continuar
                    else {

                        var id_sugested_new_number = '';
                        var sugested_new_number = '';

                        //pode acontecer de não ter número sugerido
                        if(data[0].split('_')[0] == ''){

                            $('.btn_chamador').hide();
                            id_sugested_new_number = '';
                            sugested_new_number = 'Não existem números disponíveis!';
                            $('#sugested_number').text(sugested_new_number);

                        } else {

                            // atera o numero sugerido
                            id_sugested_new_number = data[0].split('_')[0];
                            sugested_new_number = data[0].split('_')[1];
                            $('#sugested_number').text(sugested_new_number);
                            $('.btn_chamador').attr("id", "chamar_" + id_sugested_new_number);

                        }

                        var id_called_number = data[1].split('_')[0];
                        var called_number = data[1].split('_')[1];

                        // cria o espaço para os numeros em atendimento

                        // clono primeiro
                        $('#base_').clone().attr('id', 'base_' + id_called_number).removeClass('escondido').insertAfter('#head_number');

                        // realizo os ajustes necessários
                        var ajustable_base = $('#base_' + id_called_number);

                        ajustable_base.find('.nu_number').text(called_number);
                        ajustable_base.find('.btn_aprovador').attr("id", "aprovador_" + id_called_number);
                        ajustable_base.find('.btn_reprovador').attr("id", "reprovador_" + id_called_number);
                        ajustable_base.find('.btn_excluidor').attr("id", "excluidor_" + id_called_number);
                        ajustable_base.find('.btn_recall').attr("id", "recall_" + id_called_number);

                        //retiro da tabela o numero que foi chamado

                        // remove da tabela o número
                        var table = $('.datatable').DataTable();
                        table.row('tr[data-entry-id = "' + id_called_number + '" ]').remove().draw(false);

                        // alerta de sucesso
                        toastr.success('O Número foi chamado com sucesso!', 'Sucesso!', {timeOut: 3000});

                        $('#not_number').hide();

                        // tenho que contar quantas base existe no dom
                        // para mostrar que não existem mais números disponíveis
                        // em atendimento

                        var quantos = $("div[id *= 'base_']").length;

                        if (quantos == 1) {

                            $('#not_number').remove();

                            var no_numbers_to_do = '<span id="not_number">Não existem números em atendimento</span>';
                            $('#head_number').after(no_numbers_to_do);

                        }

                    }

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível realizar a chamada!', 'Falha!', {timeOut: 3000});

                }

            });


        });

        // rechama um numero
        $(document).on('click', '.btn_recall', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/piscalls/recall/' + id,

                success: function (data) {

                    toastr.success('Número rechamado com sucesso!', 'Sucesso!', {timeOut: 3000});

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível chamar o número!', 'Falha!', {timeOut: 3000});

                }

            });

        });

        // aprova um número
        $(document).on('click', '.btn_aprovador', function (e) {

            e.preventDefault();

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/piscalls/approve/' + id,

                success: function () {
                    // alerta de sucesso
                    toastr.success('O Número foi aprovado com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#base_' + id).remove();

                    var quantos = $("div[id *= 'base_']").length;

                    if (quantos == 1) {

                        $('#not_number').remove();

                        var no_numbers_to_do = '<span id="not_number">Não existem números em atendimento</span>';
                        $('#head_number').after(no_numbers_to_do);

                    }

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível aprovar o número!', 'Falha!', {timeOut: 3000});

                }

            });


        });

        // reprova um número
        $(document).on('click', '.btn_reprovador', function (e) {

            e.preventDefault();

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/piscalls/reprove/' + id,

                success: function () {
                    // alerta de sucesso
                    toastr.success('O Número foi reprovado com sucesso!', 'Sucesso!', {timeOut: 3000});
                    $('#base_' + id).remove();

                    var quantos = $("div[id *= 'base_']").length;

                    if (quantos == 1) {

                        $('#not_number').remove();

                        var no_numbers_to_do = '<span id="not_number">Não existem números em atendimento</span>';
                        $('#head_number').after(no_numbers_to_do);

                    }

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível reprovar o número!', 'Falha!', {timeOut: 3000});

                }

            });

        });

        // exclui um número
        $(document).on('click', '.btn_excluidor', function (e) {

            e.preventDefault();

            var id = $(this).attr('id').split('_')[1];

            $.confirm({
                title: '{{ trans('global.areYouSureNumberRemove') }}',
                content: '{{ trans('global.permanentAction') }}',
                buttons: {
                    Confirmar: {
                        action: function () {
                            $.ajax({
                                type: 'POST',
                                url: '/admin/numbers/' + id,

                                data: {
                                    _method: 'DELETE',
                                    _token: '{{ csrf_token() }}',

                                },
                                success: function () {

                                    // alerta de sucesso
                                    toastr.success('O Número foi excluído com sucesso!', 'Sucesso!', {timeOut: 3000});

                                    // remove do numeros em atendimento
                                    $('#base_' + id).remove();

                                    var quantos = $("div[id *= 'base_']").length;

                                    if (quantos == 1) {

                                        $('#not_number').remove();

                                        var no_numbers_to_do = '<span id="not_number">Não existem números em atendimento</span>';
                                        $('#head_number').after(no_numbers_to_do);

                                    }

                                    // remove da tabela o número
                                    var table = $('.datatable').DataTable();
                                    table.row('tr[data-entry-id = "' + id + '" ]').remove().draw(false);

                                    // se o número for um sugerido, deverá ser trocado por outro

                                    var $call_id = $('#chamar_' + id);

                                    // 1 significa que é o mesmo número
                                    if ($call_id.length === 1) {

                                        $.ajax({
                                            type: 'GET',
                                            url: '/admin/call/suggested',

                                            success: function (data) {

                                                $('#sugested_number').text(data.number).parent().next().attr('id', 'chamar_' + data.id);

                                            },
                                            error: function () {

                                                // alert de erro
                                                toastr.error('Não foi possível obter as informações!', 'Falha!', {timeOut: 3000});

                                            }

                                        });

                                    }

                                },
                                error: function () {

                                    // alert de erro
                                    toastr.error('Não foi possível excluir o número!', 'Falha!', {timeOut: 3000});

                                }

                            });
                        },
                        btnClass: 'btn-outline-dark'
                    },
                    Cancelar: {
                        btnClass: 'btn-outline-danger'
                    },
                },
                columnClass: 'col-md-6'
            });


        });

        // errors
        @if (Request::session()->has('error'))
        toastr.error('{{ Request::session()->get('error') }}', 'Erro!', {
            timeOut: 4000,
            closeButton: true,
            progressBar: true
        });
        // Success
        @elseif (Request::session()->has('acao'))
        toastr.success('{{ Request::session()->get('acao') }}', 'Sucesso!', {
            timeOut: 4000,
            closeButton: true,
            progressBar: true
        });
        @endif

    </script>

@endsection
@endsection
