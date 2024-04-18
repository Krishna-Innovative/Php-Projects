@if($hasFamilyHistory)
<tr>
    <td  colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left"><h5>{{$title['family_medical_history']}}</h5></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($family_medical_history); $i++)
    @if (count($family_medical_history[$i]) > 1)
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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['family_medical_history']['family_medical_history']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['family_medical_history']['type']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                        {{isset($family_medical_history[$i]['type']) ? FamilyHistoryCondition::find($family_medical_history[$i]['type'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['family_medical_history']['relationship']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                        {{isset($family_medical_history[$i]['relationship']) ? FamilyMember::find($family_medical_history[$i]['relationship'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline" width="50%">
                    <div class="avoid-break">
                        {{$labels['medical']['family_medical_history']['severity']}}
                    </div>
                    </td>
                    <td colspan="3" align="right" class="underline" width="50%">
                    <div class="avoid-break">
                        {{isset($family_medical_history[$i]['severity']) ? FamilyHistorySeverity::find($family_medical_history[$i]['severity'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">{{$labels['medical']['family_medical_history']['note']}}</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                    {{isset($family_medical_history[$i]['notes']) ? $family_medical_history[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </table>
        </td>
        @endif
        @if($i&1 && count($family_medical_history) > $i + 1)
        </tr><tr>
        @endif
    @endfor
</tr>
@endif