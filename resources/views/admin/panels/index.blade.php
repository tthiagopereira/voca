@extends('layouts.admin')
@section('content')

    {{--header--}}
    <div class="text-center alert alert-meu">
        <h2><i class="fas fa-desktop"></i> <span class="audiowide"> Gerenciamento de Painéis </span>
            <i class="fas fa-desktop"></i></h2>
    </div>

    {{--campo para cadastro de painéis--}}
    @can('Pode criar painel')

        <div class="card">

            {{--card header--}}
            <div class="card-header">
                {{ trans('global.panels.fields.add_guiche') }}
            </div>

            {{--card body--}}
            <div class="card-body">

                <form action="{{ route("admin.panels.store") }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    {{--identificação e ip da máquina--}}
                    <div class="row">

                        {{--identificação do painel--}}
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

                    {{--chama pa, pis e pe--}}
                    <div class="row">

                        {{--chama pa--}}
                        <div class="col">

                            <div class="form-check text-left">
                                <input class="form-check-input" type="checkbox" value="Sim" id="chama_pa"
                                       name="chama_pa">
                                <label class="form-check-label" for="chama_pa">
                                    Faz chamada do PA
                                </label>
                            </div>

                        </div>

                        {{--chama pis--}}
                        <div class="col text-center">

                            <div class="form-check text-center">
                                <input class="form-check-input" type="checkbox" value="Sim" id="chama_pis"
                                       name="chama_pis">
                                <label class="form-check-label" for="chama_pis">
                                    Faz chamada do PIS
                                </label>
                            </div>

                        </div>

                        {{--chama pe--}}
                        <div class="col text-right">

                            <div class="form-check text-right">
                                <input class="form-check-input" type="checkbox" value="Sim" id="chama_pe"
                                       name="chama_pe">
                                <label class="form-check-label" for="chama_pe">
                                    Faz chamada do PE
                                </label>
                            </div>

                        </div>


                    </div>
                    <br><br>

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
            {{ trans('global.list') }} {{ trans('global.panels.title') }}
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

                        {{--chama pa--}}
                        <th>
                            Chama PA
                        </th>

                        {{--chama pis--}}
                        <th>
                            Chama PIS
                        </th>

                        {{--chama pe--}}
                        <th>
                            Chama PE
                        </th>

                        {{--acoes--}}
                        <th class="text-center">
                            {{ trans('global.actions') }}
                        </th>

                    </tr>

                    </thead>

                    {{--tbody--}}
                    <tbody>
                    @foreach($panels as $key => $panel)

                        <tr data-entry-id="{{ $panel->id }}">

                            {{--identificação--}}
                            <td>
                                {{ $panel->identification }}
                            </td>

                            {{--ip--}}
                            <td>
                                {{ $panel->ip }}
                            </td>

                            {{--chama PA--}}
                            <td>
                                @if($panel->chama_pa)
                                    Sim
                                @else
                                    Não
                                @endif
                            </td>

                            {{--chama PIS--}}
                            <td>
                                @if($panel->chama_pis)
                                    Sim
                                @else
                                    Não
                                @endif
                            </td>

                            {{--chama PE--}}
                            <td>
                                @if($panel->chama_pe)
                                    Sim
                                @else
                                    Não
                                @endif
                            </td>


                            {{--actions--}}
                            <td class="text-center">

                                {{--editar painel--}}
                                @can('Pode editar painel')

                                    <button type="button" class="btn btn-xs btn-info edit_panel" data-toggle="modal"
                                            data-target="#panelEditModal" title="{{ trans('global.view') }}"
                                            id="panelEdit_{{$panel->id}}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                @endcan

                                {{--excluir painel--}}
                                @can('Pode excluir painel')
                                    <form action="{{ route('admin.panels.destroy', $panel->id) }}" method="POST"
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

    {{--modal de editar painel--}}
    <div class="modal fade" id="panelEditModal" tabindex="-1" role="dialog" aria-labelledby="panelEditModallLabel"
         aria-hidden="true">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                {{--modal header--}}
                <div class="modal-header">

                    <h5 class="modal-title" id="panelEditModalLabel">Edição do painel - <span
                            class="the_panel"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

                {{--modal body--}}
                <form action="" method="POST" enctype="multipart/form-data" id="form_edit_panel">
                    <div class="modal-body">

                        @csrf
                        @method('PUT')

                        {{--identificação--}}
                        <div class="form-group">

                            <label for="identification_edit">Altere a identificação do painel se desejar</label>
                            <input type="text" id="identification_edit" name="identification_edit" class="form-control"
                                   value="" required autocomplete="off">
                            <input type="hidden" id="panel_edit_id" name="panel_edit_id" class="form-control"
                                   value="">

                        </div>

                        {{--ip--}}
                        <div class="form-group">

                            <label for="ip_edit">Altere o IP do painel se desejar</label>
                            <input type="text" id="ip_edit" name="ip_edit" class="form-control"
                                   value="" required autocomplete="off">

                        </div>

                        {{--chama pa--}}
                        <div class="row">

                            <div class="col-12">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Sim" id="chama_pa_edit"
                                           name="chama_pa">
                                    <label class="form-check-label" for="chama_pa_edit">
                                        Faz chamada do PA
                                    </label>
                                </div>

                            </div>

                        </div>

                        {{--chama pis--}}
                        <div class="row">

                            <div class="col-12">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Sim" id="chama_pis_edit"
                                           name="chama_pis">
                                    <label class="form-check-label" for="chama_pis_edit">
                                        Faz chamada do PIS
                                    </label>
                                </div>

                            </div>

                        </div>

                        {{--chama pe--}}
                        <div class="row">

                            <div class="col-12">

                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="Sim" id="chama_pe_edit"
                                           name="chama_pe">
                                    <label class="form-check-label" for="chama_pe_edit">
                                        Faz chamada do PE
                                    </label>
                                </div>

                            </div>

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

        // carrega um painel para edição
        $(document).on('click', '.edit_panel', function () {

            var id = $(this).attr('id').split('_')[1];

            $.ajax({
                type: 'GET',
                url: '/admin/panels/' + id,

                success: function (data) {

                    console.log(data);

                    $('.the_panel').text(data.identification);
                    $('#identification_edit').val(data.identification);
                    $('#ip_edit').val(data.ip);
                    $('#panel_edit_id').val(data.id);
                    $("#form_edit_panel").attr("action", "/admin/panels/" + data.id);

                    if(data.chama_pa == 'Sim') {
                        $('#chama_pa_edit').prop('checked', true);
                    } else {
                        $('#chama_pa_edit').prop('checked', false);
                    }

                    if(data.chama_pis == 'Sim') {
                        $('#chama_pis_edit').prop('checked', true);
                    } else {
                        $('#chama_pis_edit').prop('checked', false);
                    }

                    if(data.chama_pe == 'Sim') {
                        $('#chama_pe_edit').prop('checked', true);
                    } else {
                        $('#chama_pe_edit').prop('checked', false)
                    }
                },
                error: function () {

                    // alert de erro
                    toastr.error('Não foi possível obter as informações!', 'Falha!', {timeOut: 3000});

                }

            });

            $('#panelEditModal').modal('show');

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
