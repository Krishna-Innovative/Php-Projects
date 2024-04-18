@if($hasHospitalRecords)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['hospital_records']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($hospital_records); $i++)
    @if (count($hospital_records[$i]) > 1)
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
                    <td colspan="6" align="center" class="record-header">{{$labels['records']['hospital_records']['hospital_records']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['records']['hospital_records']['date']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                    {{isset($hospital_records[$i]['date']) ? full_date($hospital_records[$i]['date']['year'], $hospital_records[$i]['date']['month'], $hospital_records[$i]['date']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['records']['hospital_records']['category']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        <span style="text-transform: capitalize;">{{isset($hospital_records[$i]['category']) ? HospitalisationReason::find($hospital_records[$i]['category'])->getName() : ''}}</span>
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                    {{$labels['records']['hospital_records']['practitioner']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{ isset($hospital_records[$i]['practitioner'])  ?
                        full_name(default_empty($hospital_records[$i]['practitioner'],'first_name'),
                        default_empty($hospital_records[$i]['practitioner'],'last_name'),
                        default_empty($hospital_records[$i]['practitioner'],'middle_name'))
                        : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">{{$labels['records']['hospital_records']['note']}}</td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                    {{{$hospital_records[$i]['notes'] or ''}}}
                    </div>
                    </td>
                </tr>
                @if(isset($hospital_records[$i]['file']))
                <tr>
                    <td colspan="6" align="left">{{$labels['records']['hospital_records']['attachment']}}</td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline" style="font-size: x-small;">
                        <?php 
                            $arr = explode(',',$hospital_records[$i]['file']);
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
    @if($i&1 && count($hospital_records) > $i + 1)
    </tr><tr>
    @endif
@endfor
</tr>
@endif