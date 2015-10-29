<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html>
<table dir="rtl">
    <tbody>
    <tr>
        <td colspan="6" dir="rtl" style="background-color:#e6c7ff; vertical-align: middle; text-align: center" height="40" id="title">{{ $questionnaire->title }}</td>
    </tr>
    <tr style="text-align: right; height: 30px">
        <td style="text-align: right; height: 30px"><b>درصد رای</b></td>
        <td style="text-align: right; height: 30px"><b>تعداد رای</b></td>
        <td style="text-align: right; height: 30px" colspan="4"><b>گزینه ها</b></td>
    </tr>
    @foreach($questionnaire->questions()->get() as $question)
        <tr>
            <td colspan="6" style="background-color:#e6c7ff; vertical-align: middle; text-align: right" height="20">{{ $question->title }}</td>
        </tr>
        @foreach($question->options()->get() as $option)
            <tr>
                <td style="text-align: right" height="15" >{{ $option->num_vote*100/($total_ticks[$question->id]) }}%</td>
                <td style="text-align: right" height="15" >{{ $option->num_vote }}</td>
                <td colspan="4" style="text-align: right" height="15" >{{ $option->name }}</td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
</html>