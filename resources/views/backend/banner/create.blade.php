@extends('backend.layouts.app')

@section ('title', trans('labels.backend.banner.management') . ' | ' . trans('labels.backend.banner.create'))

@section('page-header')
<h1>
    {{ trans('labels.backend.banner.management') }}
    <small>{{ trans('labels.backend.banner.create') }}</small>
</h1> 

@endsection


@section('content')
<div class="row">

    <div class="col-md-12">
        {{ Form::open(['route' => 'admin.banner.store', 'class' => 'form-horizontal', 'role' => 'form' ,'files'=>true, 'method' => 'post', 'id' => 'create-banner']) }}

        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">{{ trans('labels.backend.banner.create') }}</h3>
            </div><!-- /.box-header -->

            <div class="box-body">
                    <div class="form-group">
                        <div class="col-lg-12">
                            <label>{{ trans('validation.attributes.backend.banner.bannername') }} <span class="required">*</span> </label>
                            {{ Form::text('name', null, ['class' => 'form-control', 'maxlength' => '191', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.banner.bannername')]) }}
                        </div>
                    </div>
            
                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.bannertext') }} <span class="required">*</span> </label>
                            {{ Form::textarea('text', null, ['class' => 'form-control', 'rows' => '5','autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.banner.bannertext')]) }}
                        </div>
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.bannersidetext') }} <span class="required">*</span> </label>
                            {{ Form::textarea('sidetext', null, ['class' => 'form-control', 'rows' => '5','autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.banner.bannersidetext')]) }}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.redirecturl') }} <span class="required">*</span> : http://www.google.com</label>
                            {{ Form::url('url', null, ['class' => 'form-control', 'autofocus' => 'autofocus', 'placeholder' => trans('validation.attributes.backend.banner.redirecturl')]) }}
                        </div>
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.image') }} <span class="required">*</span> </label>
                            {{ Form::file('image', null, ['class' => 'form-control'])}}
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.order_number') }} <span class="required">*</span> </label>
                            {{ Form::number('order_number', null, ['class' => 'form-control', 'min' => '0', 'placeholder' => trans('validation.attributes.backend.banner.order_number')]) }}
                        </div>
                        <div class="col-lg-6">
                            <label>{{ trans('validation.attributes.backend.banner.status') }} <span class="required">*</span> </label>
                            {{ Form::select('status', array('1' => trans('labels.general.active'), '0' => trans('labels.general.inactive')), 'active', ['class' => 'form-control']) }}
                        </div>
                    </div>
                    <!-- /.form-group -->
            </div>





















            
        </div><!--box-->

        <div class="box box-success">
            <div class="box-body">
                <div class="pull-left">
                    {{ link_to_route('admin.banner.index', trans('buttons.general.cancel'), [], ['class' => 'btn btn-danger btn-xs']) }}
                </div><!--pull-left-->

                <div class="pull-right">
                    {{ Form::submit(trans('buttons.general.crud.create'), ['class' => 'btn btn-success btn-xs']) }}
                </div><!--pull-right-->

                <div class="clearfix"></div>
            </div><!-- /.box-body -->
        </div><!--box-->

        {{ Form::close() }}
    </div>

</div>
<!-- /.row -->
@endsection

