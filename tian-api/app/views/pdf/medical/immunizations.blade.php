@if($hasImmunizations)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['immunization_info']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($immunizations); $i++)
    @if (count($immunizations[$i]) > 1)
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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['immunization']['immunization']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['name']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['name']) ? Immunization::find($immunizations[$i]['name'])->getName(): ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['product']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['pname']) ? $immunizations[$i]['pname'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['manufacturer']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['pname']) ? $immunizations[$i]['mfname'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['ltnumber']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['pname']) ? $immunizations[$i]['lotnumber'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['serialnumber']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['pname']) ? $immunizations[$i]['srnumber'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['date']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['date']) ? full_date($immunizations[$i]['date']['year'], $immunizations[$i]['date']['month'], $immunizations[$i]['date']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['series']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                    {{{$immunizations[$i]['series'] or ''}}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['medical']['immunization']['attachment']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        @if(isset($immunizations[$i]['document']))
                            <?php 
                            $arr = explode(',',$immunizations[$i]['document']);
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
                    <td colspan="6" align="left">{{$labels['medical']['immunization']['note']}}
                    </td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                    {{isset($immunizations[$i]['notes']) ? $immunizations[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($immunizations) > $i + 1)
    </tr><tr>
    @endif
@endfor
</tr>
@endif