@if($hasSurgical)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left" ><h5>{{$title['surgical_history_info']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($surgical_history); $i++)
    @if (count($surgical_history[$i]) > 1)

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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['surgical_history']['surgical_history']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['surgical_history']['category']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                        {{isset($surgical_history[$i]['type']) ? Surgery::find($surgical_history[$i]['type'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['surgical_history']['date']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                    {{isset($surgical_history[$i]['date']) ?full_date($surgical_history[$i]['date']['year'], $surgical_history[$i]['date']['month'],    $surgical_history[$i]['date']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['surgical_history']['reason']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                        {{{$surgical_history[$i]['reason'] or ''}}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">{{$labels['medical']['surgical_history']['attachment']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    @if(isset($surgical_history[$i]['document']))
                        <?php 
                        $arr = explode(',',$surgical_history[$i]['document']);
                        foreach($arr as $val_new){
                            echo '<div class="avoid-break">'.$val_new.'</div>';
                        }
                        ?>
                    @else
                    <div class="avoid-break">
                    </div>
                    @endif
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">{{$labels['medical']['surgical_history']['note']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                        {{isset($surgical_history[$i]['notes']) ? $surgical_history[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($surgical_history) > $i + 1)
    </tr><tr>
    @endif
@endfor
</tr>
@endif