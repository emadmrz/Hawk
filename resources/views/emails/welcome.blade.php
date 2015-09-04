<div align="center">
    <table border="0" cellspacing="0" cellpadding="0" style="max-width:600px">
        <tbody>
        <tr>
            <td>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody>
                    <tr>
                        <td align="left"><img src="{{ asset('img/logo/protected.png') }}" width="32px" height="32px" style="display:block"></td>
                        <td align="right"><img src="{{ asset('img/logo/skillema_dark.png') }}" width="80px" height="32px" style="display:block"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr height="16"></tr>
        <tr>
            <td>
                <table bgcolor="#8456A7" width="100%" border="0" cellspacing="0" cellpadding="0"
                       style="min-width:332px;max-width:600px;border:1px solid #e0e0e0;border-bottom:0;border-top-left-radius:3px;border-top-right-radius:3px">
                    <tbody>
                    <tr>
                        <td height="72px" colspan="3"></td>
                    </tr>
                    <tr>
                        <td width="32px"></td>
                        <td align="right" dir="rtl" style="font-family:Tahoma,Roboto-Regular,Helvetica,Arial,sans-serif;font-size:20px;color:#ffffff;line-height:1.25">
                            به شبکه اجتماعی مهارت Skillema خوش آمدید
                        </td>
                        <td width="32px"></td>
                    </tr>
                    <tr>
                        <td height="18px" colspan="3"></td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table dir="rtl" bgcolor="#FAFAFA" width="100%" border="0" cellspacing="0" cellpadding="0"
                       style="min-width:332px;max-width:600px;border:1px solid #f0f0f0;border-bottom:1px solid #c0c0c0;border-top:0;border-bottom-left-radius:3px;border-bottom-right-radius:3px">
                    <tbody>
                    <tr height="16px">
                        <td width="32px" rowspan="3"></td>
                        <td></td>
                        <td width="32px" rowspan="3"></td>
                    </tr>
                    <tr>
                        <td>
                            <table style="min-width:300px" border="0" cellspacing="0" cellpadding="0">
                                <tbody>
                                <tr>
                                    <td style="font-family:Tahoma,Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5">
                                        کاربر گرامی ،
                                        {{ $user['first_name'] }} {{ $user['last_name'] }}

                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family:Tahoma,Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5">
                                        با تشکر از انتخاب شبکه اجتماعی مهارت ما، شما با استفاده از آدرس ایمیل <a href="mailto:{{ $user['email'] }}"target="_blank">{{ $user['email'] }}</a>
                                        به ما پیوسته اید. برای فعال سازی آدرس ایمیل خود و استفاده بدون محدودیت از امکانات سایت لطفاً بر روی لینک زیر کلیک نمایید.
                                        <br><br>
                                        <div align="center" dir="ltr">
                                            <a href="{{ url('auth/email',[ $user['confirmation_code'] ]) }}" target="_blank">{{ url('auth/email',[ $user['confirmation_code'] ]) }}</a>
                                        </div>
                                    </td>
                                </tr>
                                <tr height="32px"></tr>
                                <tr>
                                    <td style="font-family:Tahoma,Roboto-Regular,Helvetica,Arial,sans-serif;font-size:13px;color:#202020;line-height:1.5">
                                        با احترام<br>تیم مدیریت کاربران skillema
                                    </td>
                                </tr>
                                <tr height="16px"></tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <tr height="32px"></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr height="16"></tr>
        <tr>
            <td style="max-width:600px;font-family:Tahoma,Roboto-Regular,Helvetica,Arial,sans-serif;font-size:10px;color:#bcbcbc;line-height:1.5"></td>
        </tr>
        </tbody>
    </table>
</div>