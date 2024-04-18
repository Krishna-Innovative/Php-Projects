@if($hasAllergies)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic" align="left">
                <div class="avoid-break">
                    <h5>{{$title['allergy_info']}}</h5>
                </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($allergies); $i++)
    @if (count($allergies[$i]) > 1)

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
                    <td colspan="6" align="center" class="record-header">{{$labels['medical']['allergy']['allergy']}} {{$i + 1}}</td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['allergy']['name']}}
                    </div>
                    </td>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($allergies[$i]['name']) ? Allergy::find($allergies[$i]['name'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="1" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['allergy']['reaction']}}</td>
                    </div>
                    <td colspan="5" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($allergies[$i]['reaction']) ? AllergyReaction::find($allergies[$i]['reaction'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="left" class="underline">
                    <div class="avoid-break">
                        {{$labels['medical']['allergy']['severity']}}</td>
                    </div>
                    <td colspan="3" align="right" class="underline">
                    <div class="avoid-break">
                        {{isset($allergies[$i]['severity']) ? AllergySeverity::find($allergies[$i]['severity'])->getName() : ''}}
                    </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="6" align="left">
                    {{$labels['medical']['allergy']['attachment']}}
                    </td>
                </tr>
                <tr>
                    <td></td>
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
                    <td colspan="6" align="left">
                    {{$labels['medical']['allergy']['note']}}
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="6" align="left" class="underline">
                    <div class="avoid-break">
                        {{isset($allergies[$i]['notes']) ? $allergies[$i]['notes'] : ''}}
                    </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </td>
    @endif
    @if($i&1 && count($allergies) > $i + 1)
        </tr><tr>
    @endif
@endfor
</tr>
@endif