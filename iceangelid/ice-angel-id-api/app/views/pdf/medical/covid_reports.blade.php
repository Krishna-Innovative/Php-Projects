@if($hasCovidReports)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left">
                <div class="avoid-break">
                    <h5>{{$title['covid_info']}}</h5>
                </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($covid_reports); $i++)
    @if (count($covid_reports[$i]) > 1)

    @if ($i&1)
        <td colspan="3" style="padding-left: 25px;">
    @else
        <td colspan="3">
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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['covid']['covid']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['category']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['pcategory']) ? Covid::where(['value'=>$covid_reports[$i]['pcategory']])->first()->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['product']}}</td>
                    </div>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['pname']) ? $covid_reports[$i]['pname'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['manufacturer']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['mfname']) ? $covid_reports[$i]['mfname'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['ltnumber']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['lotnumber']) ? $covid_reports[$i]['lotnumber'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['serialnumber']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['srnumber']) ? $covid_reports[$i]['srnumber'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['covidresult']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['result']) ? $covid_reports[$i]['result'] : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['covid']['covidresult']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">{{isset($covid_reports[$i]['coviddate']) ? full_date($covid_reports[$i]['coviddate']['year'], $covid_reports[$i]['coviddate']['month'], $covid_reports[$i]['coviddate']['day']) : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">
                    {{$labels['medical']['covid']['attachment']}}
                    </td>
                </tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                        @if(isset($covid_reports[$i]['document']))
                            <?php 
                            $arr = explode(',',$covid_reports[$i]['document']);
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
                    <td colspan="6" align="left">
                    {{$labels['medical']['covid']['note']}}
                    </td>
                </tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                        {{isset($covid_reports[$i]['notes']) ? $covid_reports[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($covid_reports) > $i + 1)
        </tr><tr>
    @endif
@endfor
</tr>
@endif