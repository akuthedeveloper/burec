@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.contacts.title')</h3>
    @can('contact_create')
    <p>
        <a href="{{ route('contacts.create') }}" class="btn btn-success">@lang('quickadmin.add_new_event')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($contacts) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        @can('contact_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.contacts.fields.company')</th>
                        <th>@lang('quickadmin.contacts.fields.first-name')</th>
                        <th>@lang('quickadmin.contacts.fields.last-name')</th>
                        <th>@lang('quickadmin.contacts.fields.phone1')</th>
                        <th>@lang('quickadmin.contacts.fields.phone2')</th>
                        <th>@lang('quickadmin.contacts.fields.email')</th>
                        <th>@lang('quickadmin.contacts.fields.skype')</th>
                        <th>@lang('quickadmin.contacts.fields.address')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($contacts) > 0)
                        @foreach ($contacts as $contact)
                            <tr data-entry-id="{{ $contact->id }}">
                                @can('contact_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $contact->company->name or '' }}</td>
                                <td>{{ $contact->first_name }}</td>
                                <td>{{ $contact->last_name }}</td>
                                <td>{{ $contact->phone1 }}</td>
                                <td>{{ $contact->phone2 }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->skype }}</td>
                                <td>{{ $contact->address }}</td>
                                <td>
                                    @can('contact_view')
                                    <a href="{{ route('contacts.show',[$contact->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    @endcan
                                    @can('contact_edit')
                                    <a href="{{ route('contacts.edit',[$contact->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    @endcan
                                    @can('contact_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['contacts.destroy', $contact->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('contact_delete')
            window.route_mass_crud_entries_destroy = '{{ route('contacts.mass_destroy') }}';
        @endcan

    </script>
@endsection