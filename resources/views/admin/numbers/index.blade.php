@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><span class="audiowide"> Gerenciamento de Números ( PA ) </span></h2>
    </div>

    {{--campo para cadastro de numeros--}}
    @can('Pode criar número')

        <div class="card">

            {{--card header--}}
            <div class="card-header">
                {{ trans('global.number.fields.add_number') }}
            </div>

            {{--card body--}}
            <div class="card-body">

                <form action="{{ route("admin.numbers.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group {{ $errors->has('number') ? 'has-error' : '' }}">
                        <label for="number">{{ trans('global.number.fields.insert_number') }}*</label>
                        <input type="number" id="number" name="number" class="form-control" min=1
                               value="{{ old('number', isset($number) ? $number->number : $sugested_number) }}">
                        @if($errors->has('number'))
                            <em class="invalid-feedback">
                                {{ $errors->first('number') }}
                            </em>
                        @endif
                        <p class="helper-block">
                            {{ trans('global.number.fields.number_add_helper') }}
                        </p>
                    </div>

                    {{--submit--}}
                    <div>
                        <input class="btn btn-success" type="submit" value="{{ trans('global.cadastrar') }}">
                    </div>

                </form>

            </div>

        </div>

    @endcan

    {{--lista de numeros cadastrados--}}
    <div class="card">
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('global.number.title') }}
        </div>

        <div class="card-body">

            <div class="table-responsive">

                <table class=" table table-bordered table-striped table-hover datatable">

                    {{--thead--}}
                    <thead>

                    <tr>

                        {{--espaço para checkbox (marcar Todos)--}}
                        <th width="10">

                            <div class="form-check text-center pl-4">
                                <input class="form-check-input" type="checkbox" value="Sim" id="select_all">
                                <label class="form-check-label" for="select_all">
                                </label>
                            </div>


                        </th>

                        {{--numero--}}
                        <th>
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

                            {{--checkbox--}}
                            <td>

                            </td>

                            {{--number--}}
                            <td>
                                {{ $number->number }}
                            </td>

                            {{--actions--}}
                            <td class="text-center">

                                {{--Chamar numero PA--}}
                                @can('Pode confirmar um número')

                                    @if ($number->status_pa != 1)

                                        <button type="button" class="btn btn-xs btn-success call_number_pa"
                                                title="{{ trans('global.confirm_data') }}"
                                                id="numberCall_{{$number->id}}">
                                            <i class="fa fa-bullhorn"></i>
                                        </button>

                                    @endif

                                @endcan

                                {{--Confirmar dados--}}
                                @can('Pode confirmar um número')

                                    @if ($number->status_pa != 1)

                                        <button type="button" class="btn btn-xs btn-warning confirm_number"
                                                title="{{ trans('global.confirm_data') }}"
                                                id="numberConfirm_{{$number->id}}">
                                            <i class="fa fa-check"></i>
                                        </button>

                                    @endif

                                @endcan


                                {{--ver informações--}}
                                @can('Pode ver detalhes de um número')

                                    <button type="button" class="btn btn-xs btn-primary show_info" data-toggle="modal"
                                            data-target="#numberModal" title="{{ trans('global.view') }}"
                                            id="number_{{$number->id}}">
                                        <i class="fa fa-search"></i>
                                    </button>

                                @endcan

                                {{--só pode editar ou excluir um número se não tiver sido chamado pelo pis--}}
                                @if ($number->pis == 0)

                                    {{--editar numero--}}
                                    @can('Pode editar números')

                                        <button type="button" class="btn btn-xs btn-info edit_number"
                                                data-toggle="modal"
                                                data-target="#numberEditModal" title="{{ trans('global.edit') }}"
                                                id="numberEdit_{{$number->id}}">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                    @endcan

                                    {{--excluir numero--}}

                                    @can('Pode excluir números')
                                        <form action="{{ route('admin.numbers.destroy', $number->id) }}" method="POST"
                                              onsubmit="return confirm('{{ trans('global.areYouSureNumberRemove') }} \n{{ trans('global.permanentAction') }}');"
                                              style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button type="submit" class="btn btn-xs btn-danger"
                                                    title="{{ trans('global.delete') }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    @endcan
                                @endif

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    @can('Pode excluir números')
        <button type="button" class="btn btn-danger reset_all" data-toggle="modal"
                data-target="#resetModal" title="{{ trans('global.reset') }}">
            Resetar todos os números <i class="fa fa-warning"></i>
        </button>
    @endcan

    @can('Pode excluir números')
        <button type="button" class="btn btn-danger reset_panel" data-toggle="modal"
                data-target="#resetPanelModal" title="{{ trans('global.reset') }}">
            Resetar todos os painéis <i class="fa fa-desktop"></i>
        </button>
    @endcan

    <br><br>

    {{--modal de exibir detalhes de números--}}
    <div class="modal fade" id="numberModal" tabindex="-1" role="dialog" aria-labelledby="numberModalLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="numberModalLabel">Detalhes sobre o número - <span
                            class="the_number"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <div class="modal-body">

                    <b>Número de chamada:</b> <span class="the_number"></span><br>
                    <b>Já foi chamado pelo PIS:</b> <span class="chamado_pis"></span><br>
                    <b>Já foi chamado pelo PE:</b> <span class="chamado_pe"></span><br>
                    <b>Criado em:</b> <span class="data_criacao"></span><br>

                </div>

                {{--modal footer--}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                </div>

            </div>

        </div>

    </div>

    {{--modal de editar número--}}
    <div class="modal fade" id="numberEditModal" tabindex="-1" role="dialog" aria-labelledby="numberEditModallLabel"
         aria-hidden="true">

        <div class="modal-dialog modal-sm" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="numberEditModalLabel">Edição do número - <span
                            class="the_number"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit_number">
                    <div class="modal-body">

                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <label for="number_edit">Altere o número se desejar</label>
                            <input type="text" id="number_edit" name="number_edit" class="form-control the_number"
                                   value="" required autocomplete="off">
                            <input type="hidden" id="number_edit_id" name="number_edit_id" class="form-control"
                                   value="">

                        </div>

                    </div>

                    {{--modal footer--}}
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">

                    </div>

                </form>

            </div>

        </div>

    </div>

    {{--modal de resetar todos os números--}}
    <div class="modal fade" id="resetModal" tabindex="-1" role="dialog" aria-labelledby="resetModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="resetModalLabel">Resetar todos os números!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <div class="modal-body">

                    Atenção, esta ação é extremamente prejudicial a toda a operação do sistema.
                    Tenha certeza absoluta do que está fazendo aqui...

                </div>

                {{--modal footer--}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    @can('Pode excluir números')
                        <button type="button" class="btn btn-danger" id="delete_all_numbers" data-dismiss="modal">
                            Resetar
                        </button>
                    @endcan

                </div>

            </div>

        </div>

    </div>

    {{--modal de resetar todos os painéis--}}
    <div class="modal fade" id="resetPanelModal" tabindex="-1" role="dialog" aria-labelledby="resetPanelModalLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="resetModalLabel">Resetar todos os Painéis!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <div class="modal-body">

                    Atenção, esta ação é extremamente prejudicial a toda a operação do sistema.
                    Tenha certeza absoluta do que está fazendo aqui...
                    Todos os números em painéis serão excluídos.

                </div>

                {{--modal footer--}}
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    @can('Pode excluir números')
                        <button type="button" class="btn btn-danger" id="delete_all_panels" data-dismiss="modal">
                            Resetar
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
            let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
            let deleteButton = {
                text: deleteButtonTrans,
                //url: "admin/destroynumbers",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                    var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                        return $(entry).data('entry-id')
                    });

                    if (ids.length === 0) {
                        alert('{{ trans('global.datatables.zero_selected') }}')

                        return
                    }

                    if (confirm('{{ trans('global.areYouSureNumberRemove') }}')) {

                        $.ajaxSetup({

                            headers: {

                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                            }

                        });

                        $.ajax({
                            type: 'POST',
                            url: '/admin/destroynumbers',
                            data: {
                                ids: ids,
                                _method: 'DELETE',
                            },

                            success: function () {

                                toastr.success('Números removidos com sucesso!', 'Sucesso!', {timeOut: 3000});

                                setTimeout(location.reload(), 1200);

                            },

                            error: function (data) {

                                console.log(data);
                                // alert de erro
                                toastr.error('Não foi possível remover os números!', 'Falha!', {timeOut: 3000});

                            }

                        });


                    }
                }
            }
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            @can('Pode excluir números')
            dtButtons.push(deleteButton);
            @endcan

            $('.datatable:not(.ajaxTable)').DataTable({buttons: dtButtons, order: [[1, "desc"]]})
        })

        //seleciona tudo (para delete)
        $(document).on('click', '#select_all', function () {

            if ($(this).prop('checked') == true) {
                console.log('true');


                var ids = $.map(dt.rows({selected: true}).nodes(), function (entry) {
                    return $(entry).data('entry-id')
                });


            } else {
                console.log('false');
            }

        });

        // carrega os detalhes de um numero
        $(document).on('click', '.show_info', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/numbers/' + id,

                success: function (data) {

                    // numero
                    $('.the_number').text(data.number);
                    // se foi chamado pelo PIS
                    var pis;
                    if (data.pis === 0) {
                        pis = 'Não'
                    } else {
                        pis = 'Sim'
                    }
                    $('.chamado_pis').text(pis);
                    // se foi chamado pelo PE
                    var pe;
                    if (data.pe === 0) {
                        pe = 'Não'
                    } else {
                        pe = 'Sim'
                    }
                    $('.chamado_pe').text(pe);
                    // created at
                    $('.data_criacao').text(dataHoraPtBr(data.created_at));

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível obter as informações!', 'Falha!', {timeOut: 3000});

                }

            });

            $('#numberModal').modal('show');

        });

        // carrega um numero para edição
        $(document).on('click', '.edit_number', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/numbers/' + id,

                success: function (data) {

                    // numero
                    $('.the_number').val(data.number).text(data.number);
                    $('#number_edit_id').val(data.id);
                    $("#form_edit_number").attr("action", "/admin/numbers/" + data.id);


                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível obter as informações!', 'Falha!', {timeOut: 3000});

                }

            });

            $('#numberEditModal').modal('show');

        });

        // confirma um numero
        $(document).on('click', '.confirm_number', function () {

            var id = $(this).attr('id').split('_')[1];

            $.confirm({
                title: '{{ trans('global.areYouSure') }}',
                content: '{{ trans('global.permanentAction') }}',
                buttons: {
                    Confirmar: {
                        action: function () {

                            $.ajax({
                                type: 'GET',
                                url: '/admin/numbers/confirme/' + id,

                                success: function (data) {

                                    if (data == 'success') {
                                        toastr.success('Número confirmado com sucesso!', 'Sucesso!', {timeOut: 3000});
                                    } else {
                                        toastr.error('O número ja foi confirmado por outra pessoa, por favor atualize a tela!', 'Falha!', {timeOut: 3000});
                                    }

                                    $('#numberConfirm_' + id).remove();

                                },
                                error: function () {

                                    // alert de erro
                                    toastr.error('Não foi possível confirmar o número!', 'Falha!', {timeOut: 3000});

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

        // chama um numero
        $(document).on('click', '.call_number_pa', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/numbers/call/' + id,

                success: function (data) {

                    if (data == 'error') {

                        toastr.error('O número não pode ser chamado!', 'Falha!', {timeOut: 3000});

                    } else {

                        toastr.success('Número chamado com sucesso!', 'Sucesso!', {timeOut: 3000});
                    }

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível chamar o número!', 'Falha!', {timeOut: 3000});

                }

            });

        });

        // exclui todos os números
        $(document).on('click', '#delete_all_numbers', function () {

            $.ajax({
                type: 'GET',
                url: '/admin/destroyallnumbers',

                success: function () {

                    toastr.success('Todos os números foram removidos!', 'Sucesso!', {timeOut: 3000});
                    setTimeout(location.reload(), 1200);

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível remover todos os números!', 'Falha!', {timeOut: 3000});

                }

            });

        });

        // exclui todos os números de painéis
        $(document).on('click', '#delete_all_panels', function () {

            $.ajax({
                type: 'GET',
                url: '/admin/destroyallpanels',

                success: function () {

                    toastr.success('Todos os números em painéis foram removidos!', 'Sucesso!', {timeOut: 3000});

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível remover todos os números dos painéis!', 'Falha!', {timeOut: 3000});

                }

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
