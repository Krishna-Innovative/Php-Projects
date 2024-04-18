@if($hasLivingWill)
<tr>
    <td  colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic"  align="left"><h5>{{$title['living_wills']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="3" style="padding-left: 5mm;" width="50%">
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
                    {{$labels['records']['living_wills']['date']}}
                    </div>
                    </td>
                    <td align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($living_will['date']) ? full_date($living_will['date']['year'], $living_will['date']['month'], $living_will['date']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="left">{{$labels['records']['living_wills']['note']}}</td>
                </tr>
                <tr>
                    <td colspan="2" align="left" class="underline">
                    <div class="avoid-break">
                    {{{$living_will['notes'] or ''}}}
                    </div>
                    </td>
                </tr>
                @if(isset($living_will['document']))
                <tr>
                    <td align="left" colspan="2">{{$labels['records']['living_wills']['attachment']}}</td>
                </tr>
                <tr>
                    <td colspan="2" align="left" class="underline" style="font-size: x-small;">
                        <?php 
                            $arr = explode(',',$living_will['document']);
                            foreach($arr as $val_new){
                                echo '<div class="avoid-break"><a target="_blank" href="'.$val_new.'">'.$val_new.'</a></div>';
                            }
                        ?> 
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
    </td>
</tr>
@endif