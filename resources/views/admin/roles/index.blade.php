@extends('layouts.admin')
@section('content')
@can('Pode criar funções')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.roles.create") }}">
                {{ trans('global.add') }} {{ trans('global.role.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('global.list') }} {{ trans('global.role.title_singular') }}
    </div>

    <div class="card-body">

        <div class="table-responsive">

            <table class=" table table-bordered table-striped table-hover datatable">

                {{--thead--}}
                <thead>
                    <tr>

                        {{--espaço para seleção--}}
                        <th width="10" class="align-items-center">
                        </th>
                        {{--tipo--}}
                        <th>
                            {{ trans('global.role.fields.title') }}
                        </th>

                        {{--permissões--}}
                        <th>
                            {{ trans('global.role.fields.permissions') }}
                        </th>

                        {{--ações--}}
                        <th width="100" class="text-center">
                            {{ trans('global.actions') }}
                        </th>

                    </tr>

                </thead>

                {{--tbody--}}
                <tbody>

                    @foreach($roles as $key => $role)

                        <tr data-entry-id="{{ $role->id }}">

                            {{--espaço para checkbox--}}
                            <td style="display:table-cell; vertical-align: middle !important;">

                            </td>

                            {{--nome full do tipo--}}
                            <td>
                                {{ $role->title ?? '' }}
                            </td>

                            {{--permissões--}}
                            <td>
                                @foreach($role->permissions as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>

                            {{--actions--}}
                            <td class="text-center">

                                {{--ver informações--}}
                                @can('Pode ver funções')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.roles.show', $role->id) }}" title="{{ trans('global.view') }} ">
                                        <i class="fa fa-search"></i>
                                    </a>
                                @endcan

                                {{-- editar role---}}
                                @can('Pode editar funções')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.roles.edit', $role->id) }}" title="{{ trans('global.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan

                                {{--remover role--}}
                                @can('Pode excluir funções')
                                    <form action="{{ route('admin.roles.destroy', $role->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button type="submit" class="btn btn-xs btn-danger" title="{{ trans('global.delete') }}">
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
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.roles.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('Pode excluir funções')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection
