@if(isset($contacts) && count($contacts))
<tr>
    <td colspan="6" align="left" valign="middle">
        <h6 class="topic" style="margin: 15px;">{{$title['emergency_contact_person']}}</h6>
    </td>
</tr>
<tr style="margin: 0px;">
    <td colspan="6">
        <table width="100%" cellpadding="3" cellspacing="0">
        <thead>
            <tr>
            </tr>
        </thead>
        <tbody>
            <tr>
            @for($i = 0; $i < count($contacts); $i++)
                 @if($contacts[$i]['status'] == 'accepted')
                    <td colspan="1" width="50%" align="center">                        
                        <table cellpadding="5" cellspacing="0" style="padding: 10px 10px 20px 20px; width: 100%; border: 1px solid #ccc;">
                                <tr>
                                    <td width="30%" align="right">
                                        <div>&nbsp;</div>
                                        @if (isset($contacts[$i]['photo']))
                                        <div style="width: 60px; height: 60px;">
                                            <img width="60" height="60" src="{{$contacts[$i]['photo']}}"
                                                 style="display: block; height: 100%; border: 1px solid #ccc; border-radius: 100%; -o-object-fit: cover; object-fit: cover;" alt="" />
                                        </div>
                                        @endif
                                        </td>
                                        <td width="70%" align="left">
                                            <h2>{{$contacts[$i]['first_name']}} {{$contacts[$i]['last_name']}}</h2>
                                            <div>
                        <span style="text-decoration: none; font-size: 14px;" href="tel:{{{$contacts[$i]['phone']['number'] or ''}}}">
                                                    {{{$contacts[$i]['phone']['number'] or ''}}}
                                                </span>
                                            </div>
                            <div>
                            <a style="text-decoration: none;font-size: 14px;" href="mailto:{{{$contacts[$i]['email'] or ''}}}">
                                                    {{{$contacts[$i]['email'] or ''}}}
                                                </a>
                       </div>
                                    </td>
                                </tr>
                        </table>
                    </td>
                    @if (count($contacts) & 1)
                        <td colspan="1" width="50%"></td>
                    @endif
                @endif
            @endfor
            </tr>
        </tbody>
        </table>
    </td>
</tr>
@endif