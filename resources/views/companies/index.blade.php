@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.companies.title')</h3>
    @can('company_create')
    <p>
        <a href="{{ route('companies.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($companies) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('company_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.companies.fields.name')</th>
                        <th>@lang('quickadmin.companies.fields.address')</th>
                        <th>@lang('quickadmin.companies.fields.website')</th>
                        <th>@lang('quickadmin.companies.fields.email')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($companies) > 0)
                        @foreach ($companies as $company)
                            <tr data-entry-id="{{ $company->id }}">
                                @can('company_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $company->name }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->website }}</td>
                                <td>{{ $company->email }}</td>
                                <td>
                                    @can('company_view')
                                    <a href="{{ route('companies.show',[$company->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('company_edit')
                                    <a href="{{ route('companies.edit',[$company->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('company_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['companies.destroy', $company->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('company_delete')
            window.route_mass_crud_entries_destroy = '{{ route('companies.mass_destroy') }}';
        @endcan

    </script>
@endsection