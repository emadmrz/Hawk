<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingEducation" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupEducation" aria-expanded="true" aria-controls="collapseListGroupEducation">تحصیلات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroupEducation" aria-labelledby="collapseListGroupHeadingEducation" aria-expanded="true">
            <div class="panel-body" id="education_form">

                <div class="" data-role="preview">

                    <table class="table education-table" id="education_table_preview">
                        <thead>
                            <tr>
                                <th width="15%" >مقطع</th>
                                <th width="20%" >رشته تحصیلی</th>
                                <th width="15%" >وضعیت</th>
                                <th width="25%" >دانشگاه/موسسه تحصیلی</th>
                                <th width="15%" >شروع</th>
                                <th width="15%" >اتمام</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user->educations as $education)
                                <tr data-education="{{ $education->id }}">
                                    <td>{{ $education->degree_name }}</td>
                                    <td>{{ $education->field }}</td>
                                    <td>{{ $education->status_name }}</td>
                                    <td>{{ $education->university->name }} <img src="{{ asset('img/icons/universities/'.$education->university->logo ) }}"></td>
                                    <td>{{ $education->entrance_year }}</td>
                                    <td>{{ $education->graduate_year }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
        <div style="color: #666;font-size: 13px" class="panel-footer"><i class="fa fa-clock-o fa-lg" style="margin-left: 5px; top: 0"></i>
            آخرین ویرایش چهارشنبه 28 مرداد
        </div>
    </div>
</div>