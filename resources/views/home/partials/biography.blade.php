<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingBio" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupBio" aria-expanded="true" aria-controls="collapseListGroupBio" >
                @if($role == 'legal')
                    تاریخچه
                @else
                    بیوگرافی
                @endif
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupBio" aria-labelledby="collapseListGroupHeadingBio" aria-expanded="true">
            <div class="panel-body biopraphy">
                <div data-status="preview" >{!! $user->biography->text !!}</div>
                <div class="attachments-list">
                    @if(count($user->biography->attachments) > 0)
                        <ul>
                            @foreach($user->biography->attachments as $attachment)
                                <li><b data-value="{{ $attachment->id }}" class="fa fa-times-circle" ></b><a target="_blank" href="{{ asset('img/files/'.$attachment->name) }}" >{{ $attachment->real_name }}</a><i class="fa fa-paperclip" ></i></li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
        <div class="panel-footer share-buttons">
            {{--<a href="#"><i class="fa fa-link"></i></a>--}}
            {{--<a href="#"><i class="fa fa-photo"></i></a>--}}
            {{--<a href="#"><i class="fa fa-video-camera"></i></a>--}}
            {{--<a href="#"><i class="fa fa-file"></i></a>--}}
        </div>
    </div>
</div>