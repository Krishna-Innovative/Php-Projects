@if($hasEmergencyMessages)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['emergency_messages']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($emergency_messages); $i++)
    @if (count($emergency_messages[$i]) > 1)
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
                    <td align="center" colspan="6" class="record-header">{{$labels['records']['emergency_messages']['emergency_messages']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="6" align="left">
                    <div class="avoid-break">
                    {{$labels['records']['emergency_messages']['note']}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                    {{{$emergency_messages[$i]['notes'] or ''}}}
                    </div>
                    </td>
                </tr>
                @if(isset($emergency_messages[$i]['file']))
                <tr>
                    <td colspan="6" align="left">
                    {{$labels['records']['emergency_messages']['attachment']}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline" style="font-size: x-small;">
                        <?php 
                            $arr = explode(',',$emergency_messages[$i]['file']);
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
    @endif
    @if($i&1 && count($emergency_messages) > $i + 1)
        </tr><tr>
    @endif 
@endfor
</tr>
@endif