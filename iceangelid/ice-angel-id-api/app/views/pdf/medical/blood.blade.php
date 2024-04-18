@if($hasBlood)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['blood_info']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="3">
        <table width="100%" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th width="40%"></th>
                    <th width="60%"></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['blood']['blood_type']}}
                    </div>
                    </td>
                    <td align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($medical['blood']['blood_type']) ? BloodType::find($medical['blood']['blood_type'])->type : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">
                    <div class="avoid-break">
                        {{$labels['medical']['blood']['note']}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left" class="underline">
                    <div class="avoid-break">
                        {{{$medical['blood']['notes'] or ''}}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
</tr>

@endif