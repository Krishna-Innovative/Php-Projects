@if($hasDoctors)
<tr>
    <td colspan="3">
        <table width="100%">
            <tr>
                <td align="left" ><h5>{{$title['doctor_info']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($doctors); $i++)
    @if (count($doctors[$i]) > 1)
    @if ($i&1)
        <td colspan="3" style="padding-left: 5mm;" width="50%">
    @else
        <td colspan="3" style="padding-right: 5mm;" width="50%">
    @endif
    <table width="100%" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th width="20%"></th>
                    <th width="28%"></th>
                    <th width="2%"></th>
                    <th width="2%"></th>
                    <th width="28%"></th>
                    <th width="20%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6"  align="center" class="record-header">{{$labels['medical']['doctor']['doctor']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="3"  align="left" class="underline">{{$labels['medical']['doctor']['name']}}</td>
                    <td colspan="3"  align="right" class="underline">
                        <div class="avoid-break">
                        @if (array_key_exists('last_name', $doctors[$i]))
                        {{isset($doctors[$i]['first_name']) ? full_name($doctors[$i]['first_name'], $doctors[$i]['last_name']) : full_name('', $doctors[$i]['last_name'])}}
                        @else
                        {{isset($doctors[$i]['first_name']) ? full_name($doctors[$i]['first_name'], '') : ''}}
                        @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"  align="left" class="underline">{{$labels['medical']['doctor']['telephone']}}</td>
                    <td colspan="3"  align="right" class="underline">
                    <div class="avoid-break">
                        {{{$doctors[$i]['phone']['number'] or ''}}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3"  align="left" class="underline">{{$labels['medical']['doctor']['specialty']}}</td>
                    <td colspan="3"  align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($doctors[$i]['specialty']) ? DoctorSpeciality::find($doctors[$i]['specialty'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6"  align="left">{{$labels['medical']['doctor']['note']}}</td>
                </tr>
                <tr>
                    <td colspan="6"  align="left" class="underline">
                    <div class="avoid-break">
                    {{isset($doctors[$i]['notes']) ? $doctors[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($doctors) > $i + 1)
    </tr><tr>
    @endif
@endfor
</tr>
@endif