@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><i class="fas fa-chalkboard-teacher"></i> <span class="audiowide"> Gerenciamento de Guichês de Atendimento ( PE )  </span>
            <i class="fas fa-chalkboard-teacher"></i></h2>
    </div>

    {{--campo para cadastro de guiches--}}
    @can('Pode criar guichê')

        <div class="card">

            {{--card header--}}
            <div class="card-header">
                {{ trans('global.guiches.fields.add_guiche') }}
            </div>

            {{--card body--}}
            <div class="card-body">

                <form action="{{ route("admin.guiches.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{--identificação e ip da máquina--}}
                    <div class="row">

                        {{--identificação do guichê--}}
                        <div class="col">

                            <div class="form-group {{ $errors->has('identification') ? 'has-error' : '' }}">
                                <label for="identification">{{ trans('global.guiches.fields.identification') }}*</label>
                                <input type="text" id="identification" name="identification" class="form-control"
                                       value="{{ old('identification') }}">
                                @if($errors->has('identification'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('identification') }}
                                    </em>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.guiches.fields.identification_add_helper') }}
                                </p>
                            </div>

                        </div>

                        {{--ip da máquina--}}
                        <div class="col">

                            <div class="form-group {{ $errors->has('ip') ? 'has-error' : '' }}">
                                <label for="ip">{{ trans('global.guiches.fields.ip') }}*</label>
                                <input id="ip" name="ip" class="form-control"
                                       value="{{ old('ip') }}" type="text" minlength="7" maxlength="15" size="15"
                                       pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$">

                                @if($errors->has('ip'))
                                    <em class="invalid-feedback">
                                        {{ $errors->first('ip') }}
                                    </em>
                                @endif
                                <p class="helper-block">
                                    {{ trans('global.guiches.fields.ip_add_helper') }}
                                </p>
                            </div>

                        </div>

                    </div>

                    {{--submit--}}
                    <div>
                        <input class="btn btn-success" type="submit" value="{{ trans('global.cadastrar') }}">
                    </div>

                </form>
            </div>

        </div>

    @endcan

    {{--lista de guiches cadastrados--}}
    <div class="card">

        {{--card header--}}
        <div class="card-header">
            {{ trans('global.list') }} {{ trans('global.guiches.title') }}
        </div>

        {{--card body--}}
        <div class="card-body">

            <div class="table-responsive">

                <table class=" table table-bordered table-striped table-hover datatable">

                    {{--thead--}}
                    <thead>

                    <tr>

                        {{--Identificação--}}
                        <th>
                            {{ trans('global.guiches.fields.identification') }}
                        </th>

                        {{--IP--}}
                        <th>
                            {{ trans('global.guiches.fields.ip') }}
                        </th>

                        {{--acoes--}}
                        <th class="text-center">
                            {{ trans('global.actions') }}
                        </th>

                    </tr>

                    </thead>

                    {{--tbody--}}
                    <tbody>
                    @foreach($guiches as $key => $guiche)

                        <tr data-entry-id="{{ $guiche->id }}">

                            {{--identificação--}}
                            <td>
                                {{ $guiche->identification }}
                            </td>

                            {{--ip--}}
                            <td>
                                {{ $guiche->ip }}
                            </td>

                            {{--actions--}}
                            <td class="text-center">

                                {{--editar guiche--}}
                                @can('Pode alterar guichê')

                                    <button type="button" class="btn btn-xs btn-info edit_guiche" data-toggle="modal"
                                            data-target="#numberEditModal" title="{{ trans('global.view') }}"
                                            id="guicheEdit_{{$guiche->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                @endcan

                                {{--excluir guiche--}}
                                @can('Pode excluir guichê')
                                    <form action="{{ route('admin.guiches.destroy', $guiche->id) }}" method="POST"
                                          onsubmit="return confirm('{{ trans('global.areYouSure') }} \n{{ trans('global.permanentAction') }}');"
                                          style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger"
                                                title="{{ trans('global.delete') }}">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                @endcan

                            </td>

                        </tr>

                    @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

    {{--modal de editar guiche--}}
    <div class="modal fade" id="guicheEditModal" tabindex="-1" role="dialog" aria-labelledby="guicheEditModallLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="guicheEditModalLabel">Edição do guiche - <span
                            class="the_guiche"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit_guiche">
                    <div class="modal-body">

                        @csrf
                        @method('PUT')
                        <div class="form-group">

                            <label for="identification_edit">Altere a identificação do guiche se desejar</label>
                            <input type="text" id="identification_edit" name="identification_edit" class="form-control"
                                   value="" required autocomplete="off">
                            <input type="hidden" id="guiche_edit_id" name="guiche_edit_id" class="form-control"
                                   value="">

                        </div>

                        <div class="form-group">

                            <label for="ip_edit">Altere o IP do Guichê se desejar</label>
                            <input type="text" id="ip_edit" name="ip_edit" class="form-control"
                                   value="" required autocomplete="off">

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





@section('scripts')
    @parent
    <script>

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

        // carrega um guiche para edição
        $(document).on('click', '.edit_guiche', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/guiches/' + id,

                success: function (data) {

                    // numero
                    $('.the_guiche').text(data.identification);
                    $('#identification_edit').val(data.identification);
                    $('#ip_edit').val(data.ip);
                    $('#guiche_edit_id').val(data.id);
                    $("#form_edit_guiche").attr("action", "/admin/guiches/" + data.id);

                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível obter as informações!', 'Falha!', {timeOut: 3000});

                }

            });

            $('#guicheEditModal').modal('show');

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
