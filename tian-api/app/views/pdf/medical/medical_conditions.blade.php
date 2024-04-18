@if($hasConditions)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['medical_condition_info']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($medical_conditions); $i++)
    @if (count($medical_conditions[$i]) > 1)
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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['medical_condition']['medical_condition']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['medical_condition']['name']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($medical_conditions[$i]['name']) ? MedicalCondition::find($medical_conditions[$i]['name'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['medical_condition']['status']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($medical_conditions[$i]['status']) ? MedicalConditionStatus::find($medical_conditions[$i]['status'])->getStatus() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['medical_condition']['from']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($medical_conditions[$i]['from']) ? full_date($medical_conditions[$i]['from']['year'], $medical_conditions[$i]['from']['month'], $medical_conditions[$i]['from']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['medical_condition']['to']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($medical_conditions[$i]['to']) ? full_date($medical_conditions[$i]['to']['year'], $medical_conditions[$i]['to']['month'], $medical_conditions[$i]['to']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">{{$labels['medical']['medical_condition']['attachment']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    @if(isset($medical_conditions[$i]['document']))
                        <?php 
                        $arr = explode(',',$medical_conditions[$i]['document']);
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
                    <td colspan="6" align="left">{{$labels['medical']['medical_condition']['note']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                        {{isset($medical_conditions[$i]['notes']) ? $medical_conditions[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($medical_conditions) > $i + 1)
    </tr><tr>
    @endif
@endfor
</tr>
@endif