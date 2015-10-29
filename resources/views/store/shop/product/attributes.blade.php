@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    @include('store.shop.product.steps',['step'=>2])
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">ویژگی های کالا</div>
            <div class="panel-body">
                    <p>
                        در این بخش مختصری از قوانین مربوط به ثبت مقاله در سایت نوسشه خواهد شد و مواردی که امکان حذف مقالاتوجود دارند بیان می گردد. همچنین نحوه ارسال مقاله  و چگونه مقاله بهتر و پر بازدید تری داشته باشیم توضیح داده می شود.
                    </p>
                {!! Form::open(['route'=>['profile.management.addon.shop.product.attributes',$shop->id, $product->id], 'method'=>'post', 'data-remote']) !!}
                <div class="clearfix form-horizontal">
                    <div class="form-group panel-form">
                        {!! Form::label('attribute_group_id', 'نوع ویژگی : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            <select name="attribute_group_id" id="attribute_group_id" class="form-control">
                                @foreach($attribute_groups as $attribute_group)
                                    <option value="{{ $attribute_group->id }}" data-type="{{ $attribute_group->type }}">{{ $attribute_group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('value', 'مقدار : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::input('color', 'value', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group panel-form">
                        {!! Form::label('add_price', 'افزایش قیمت : ', ['class'=>'control-label pull-right col-sm-2']) !!}
                        <div class="col-sm-3">
                            {!! Form::input('number', 'add_price', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                </div>

                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> افزودن ویژگی </button>
                {!! Form::close() !!}
                <br>
                <table class="table table-striped text-right editable-table" id="attribute_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >نوع ویژگی</th>
                        <th  class="text-right" >مقدار</th>
                        <th  class="text-right" >افزایش قیمت (تومان)</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product->attributes()->with('attribute_group')->get() as $attribute)
                        <tr>
                            <td width="15%">{{ $attribute->attribute_group->name }}</td>
                            @if($attribute->attribute_group->type == 'color')
                                <td width="15%"><div style="background: {{ $attribute->value }}; width: 40%">&emsp;</div> </td>
                            @else
                                <td width="15%">{{ $attribute->value }}</td>
                            @endif
                            <td width="15%">{{ $attribute->add_price }}</td>
                            <td width="5%"><button id="delete_attribute" data-value="{{ $attribute->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <a href="{{ route('profile.management.addon.shop.product.edit.step3', [$shop->id, $product->id]) }}" class="btn btn-success"><i class="fa fa-save"></i> ادامه به مرحله بعد </a>
                <a href="{{ route('profile.management.addon.shop.product.edit.step1', [$shop->id, $product->id]) }}" class="btn btn-default"><i class="fa fa-times"></i>بازگشت به مرحله قبل</a>


            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>


@endsection