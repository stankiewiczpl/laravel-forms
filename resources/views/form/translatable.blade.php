@extends('admin.layouts.default')

@section('content')
    <div class="row">
        <div class="col-12">
            {!! form_start($form) !!}
            <div class="card">
                <div class="card-header">
                    {{$pageTitle}}
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist">
                        @foreach(LaravelLocalization::getSupportedLocales()  as  $localeCode => $properties)
                            <li class="nav-item">
                                <a class="nav-link @if($localeCode == request()->input('lang',app()->getLocale())) active @endif" href="{{url()->current().'?lang='.$localeCode}}">
                                    {{ svg_image('flags/'.$properties['iso_3166_2'], 'icon country-icon')->inline() }}
                                    {{mb_convert_case($properties['native'],MB_CASE_TITLE,'UTF-8')}}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    {!! form_fields($form) !!}
                </div>
                <div class="card-footer text-muted">
                    <button type="submit" form="{{$form->getFormOption('id')}}" class="btn btn-outline-primary">@lang('save and close')</button>
                    <button type="submit" form="{{$form->getFormOption('id')}}" name="post_action" value="stay" class="btn btn-outline-primary">@lang('save and stay')</button>
                </div>
            </div>
            {!! form_end($form,false) !!}
        </div>
    </div>
@endsection

@push('js')
    @if($form->getFormOption('jsValidator'))
        {!! JsValidator::formRequest($form->getFormOption('jsValidator'),'#'.$form->getFormOption('id')) !!}
    @endif

@endpush

