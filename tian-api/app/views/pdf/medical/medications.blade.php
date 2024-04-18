@if($hasMedications)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['medication_info']}}</h5>
                </td>
            </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($medications); $i++)
    @if (count($medications[$i]) > 1)
    @if ($i&1)
        <td colspan="3" style="padding-left: 5mm;">
    @else
        <td colspan="3" style="padding-right: 5mm;">
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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['medication']['medication']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['name']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                        {{{$medications[$i]['name'] or ''}}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="30%">{{$labels['medical']['medication']['status']}}</td>
                    <td colspan="3" align="right" class="underline" width="70%">{{isset($medications[$i]['status']) ? MedicationStatus::find($medications[$i]['status'])->getStatus() : ''}}</td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['dosage']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                        {{isset($medications[$i]['dosage']) && isset($medications[$i]['dosage_unit']) ? $medications[$i]['dosage'] === 0 ? '': $medications[$i]['dosage'] . ' ' . MedicationDosage::find($medications[$i]['dosage_unit'])->getName(): ''}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['frequency']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                            <span>
                            @if(isset($medications[$i]['frequency_unit']))
                                @if($medications[$i]['frequency_unit'] == 7)
                                     {{{ $medications[$i]['frequency'] or MedicationFrequency::find($medications[$i]['frequency_unit'])->getName() }}}
                                @elseif($medications[$i]['frequency_unit'] == 6)
                                    {{MedicationFrequency::find($medications[$i]['frequency_unit'])->getName()}}
                                @elseif(isset($medications[$i]['frequency']))
                                    {{{$medications[$i]['frequency'] or ''}}} {{ MedicationFrequency::find($medications[$i]['frequency_unit'])->getName() }}
                                @endif
                            @endif
                            </span>
                        </div>
                </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['purpose']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                        {{{$medications[$i]['purpose'] or ''}}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['from']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                        {{isset($medications[$i]['from']) ? full_date($medications[$i]['from']['year'], $medications[$i]['from']['month'], $medications[$i]['from']['day']) : ''}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                        {{$labels['medical']['medication']['to']}}
                        </div>
                    </td>
                    <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                        {{isset($medications[$i]['to']) ? full_date($medications[$i]['to']['year'], $medications[$i]['to']['month'], $medications[$i]['to']['day']) : ''}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">
                    {{$labels['medical']['allergy']['attachment']}}
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                        @if(isset($allergies[$i]['document']))
                            <?php 
                            $arr = explode(',',$allergies[$i]['document']);
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
                    <td colspan="6" align="left">{{$labels['medical']['medication']['note']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                        <div class="avoid-break">
                        {{isset($medications[$i]['notes']) ? $medications[$i]['notes'] : ''}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($medications) > $i + 1)
        </tr><tr>
    @endif
@endfor
</tr>
@endif