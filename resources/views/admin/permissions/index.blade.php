@extends('layouts.admin')
@section('content')

    {{--se pode criar permissões, habilita o botão....--}}
    {{--não faz sentido para essa aplicação. deverá ser removida a funcionalidade--}}
@can('Pode criar permissões')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.permissions.create") }}">
                {{ trans('global.add') }} {{ trans('global.permission.title_singular') }}
            </a>
        </div>
    </div>
@endcan


<div class="card">

    {{--card header--}}
    <div class="card-header">
        {{ trans('global.list') }}  {{ trans('global.permission.title_singular') }}
    </div>

    {{--card body--}}
    <div class="card-body">

        <div class="table-responsive">

            <table class=" table table-bordered table-striped table-hover datatable">

                {{--thead--}}
                <thead>

                    <tr>
                        {{--chechbox--}}
                        <th width="10">

                        </th>

                        {{--nome da permissão--}}
                        <th>
                            {{ trans('global.permission.fields.title') }}
                        </th>

                        {{--tipo de permissão--}}
                        <th class="text-center">
                            {{ trans('global.permission.fields.nature') }}
                        </th>

                        {{--ações--}}
                        <th class="text-center">
                            &nbsp; {{ trans('global.actions') }}
                        </th>

                    </tr>

                </thead>

                {{--tbody--}}
                <tbody>
                    @foreach($permissions as $key => $permission)

                        <tr data-entry-id="{{ $permission->id }}">

                            {{--espaço para checkbox--}}
                            <td>

                            </td>

                            {{--nome da permissão--}}
                            <td>
                                {{ $permission->title ?? '' }}
                            </td>

                            {{--tipo da permissão--}}
                            <td class="text-center">
                                {{ $permission->nature ?? ' - ' }}
                            </td>

                            {{--ações--}}
                            <td class="text-center">

                                {{--ver permissões--}}
                                @can('Pode ver permissões')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.permissions.show', $permission->id) }}" title=" {{ trans('global.view') }}">
                                       <i class="fa fa-search"></i>
                                    </a>
                                @endcan

                                {{--editar permissões--}}
                                @can('Pode editar permissões')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.permissions.edit', $permission->id) }}" title="{{ trans('global.edit') }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                @endcan

                                {{--excluir permissões--}}
                                @can('Pode excluir permissões')
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
    url: "{{ route('admin.permissions.massDestroy') }}",
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
@can('Pode excluir permissões')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons })
})

</script>
@endsection
@endsection
