@extends('profile.layout')

@section('side')
    @include('store.shop.side')
    @include('profile.partials.managementMenu')
@endsection

@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                مدیریت محصولات فروشگاه
            </div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th width="5%" class="text-right">#</th>
                        <th width="20%" class="text-right">نام کالا</th>
                        <th width="20%" class="text-right">بازدید</th>
                        <th width="20%" class="text-right">قیمت</th>
                        <th width="20%" class="text-right">تخفیف</th>
                        <th width="5%" class="text-right">وضعیت</th>
                        <th width="5%" class="text-right">نمایش</th>
                        <th width="5%" class="text-right">ویرایش</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($shop->products()->get() as $product)
                            <tr>
                                <td>1</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->num_visit }}</td>
                                <td>{{ $product->price }} تومان </td>
                                <td>{{ $product->discount }} درصد </td>
                                <td>
                                    @if($product->available)
                                        <span class="label label-success">موجود</span>
                                    @else
                                        <span class="label label-danger">نا موجود</span>
                                    @endif
                                </td>
                                <td>
                                    @if($product->status)
                                        <span class="label label-success">بله</span>
                                    @else
                                        <span class="label label-danger">خیر</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('profile.management.addon.shop.product.edit.step1', [$shop->id, $product->id]) }}"  class="btn btn-info btn-xs">ویرایش</a></td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="panel-footer text-footer">
                <i class="fa fa-clock-o fa-lg" ></i>
            </div>
        </div>
    </div>
@endsection