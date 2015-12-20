<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingBio" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupBio" aria-expanded="true" aria-controls="collapseListGroupBio" >
                مقایسه مهارت ها
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupBio" aria-labelledby="collapseListGroupHeadingBio" aria-expanded="true">
            <div class="panel-body">
                <div class="col-sm-3 pull-right" style="padding: 0">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td style="height: 149px"></td>
                            </tr>
                            <tr>
                                <td>نام و نام خانوادگی</td>
                            </tr>
                            <tr>
                                <td>عنوان مهارت</td>
                            </tr>
                            <tr>
                                <td>حقیقی/حقوقی</td>
                            </tr>
                            <tr>
                                <td>امتیاز</td>
                            </tr>
                            <tr>
                                <td>سطح مهارت</td>
                            </tr>
                            <tr>
                                <td>توصیه نامه</td>
                            </tr>
                            <tr>
                                <td>سابقه کار</td>
                            </tr>
                            <tr>
                                <td>گواهی نامه</td>
                            </tr>
                            <tr>
                                <td>تعداد مشتری</td>
                            </tr>
                            <tr>
                                <td>محصول مرتبط</td>
                            </tr>
                            <tr>
                                <td>تعداد بازدید</td>
                            </tr>
                            <tr>
                                <td>تعداد تایید مهارت</td>
                            </tr>
                            <tr>
                                <td>تعداد توصیه نامه</td>
                            </tr>
                            <tr>
                                <td>&emsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @foreach($skills as $skill)
                    <div class="col-sm-3 pull-right"  style="padding: 0">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <td class="text-center"><img class="img-rounded" src="{{ asset('img/persons/'.$skill->user->avatar) }}" ></td>
                            </tr>
                            <tr>
                                <td>{{ $skill->user->username }}</td>
                            </tr>
                            <tr>
                                <td>{{ $skill->title }}</td>
                            </tr>
                            <tr>
                                <td>
                                    @if($skill->user->roles->first()->slug == 'user')
                                        حقیقی
                                    @else
                                        حقوقی
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><div class="skill-rate ltr" style="padding: 10px" data-id="{{ $skill->id }}" data-rating="{{ $skill->rate }}"></div></td>
                            </tr>
                            <tr>
                                <td>{{ $skill->my_rate }}</td>
                            </tr>
                            <tr>
                                <td>@if(count($skill->recomendations))  <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</td>
                            </tr>
                            <tr>
                                <td>@if(count($skill->histories))  <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</td>
                            </tr>
                            <tr>
                                <td>@if(count($skill->degees))  <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</td>
                            </tr>
                            <tr>
                                <td>{{ count($skill->corporations) }}</td>
                            </tr>
                            <tr>
                                <td>@if(count($skill->products))  <i class="fa fa-check text-success"></i> @else <i class="fa fa-times text-danger"></i> @endif</td>
                            </tr>
                            <tr>
                                <td>{{ count($skill->num_visit) }}</td>
                            </tr>
                            <tr>
                                <td>{{ count($skill->endorse) }}</td>
                            </tr>
                            <tr>
                                <td>{{ count($skill->recomendation) }}</td>
                            </tr>
                            <tr class="text-center">
                                <td><a class="btn btn-xs btn-default" href="{{ route('home.compare.cancel', ['item'=>$skill->id]) }}" > حذف از مقایسه </a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
</div>

@section('script')
    <script src="{{ asset('js/raterater.js') }}"></script>
    <script>
        function rateAlert(id, rating)
        {
            alert( 'Rating for '+id+' is '+rating+' stars!' );
        }

        /* Here we initialize raterater on our rating boxes
         */
        $(function() {
            $( '.skill-rate' ).raterater( {
                submitFunction: 'rateAlert',
                allowChange: true,
                starWidth: 18,
                spaceWidth: 1,
                numStars: 5
            } );
        });
    </script>
@endsection
