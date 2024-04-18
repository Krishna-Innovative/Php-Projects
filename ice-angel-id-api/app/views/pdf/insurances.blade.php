@if($hasInsurances)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td><h4 style="margin-bottom: 10px;">{{$title['insurances']}}</h4></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    @for($i = 0; $i < count($insurances); $i++)
    @if (!empty($insurances[$i])  && count($insurances[$i]) > 1)
        @if ($i&1)
            <td colspan="3" style="padding-left: 5mm;" width="50%">
        @else
            <td colspan="3" style="padding-right: 5mm;" width="50%">
        @endif
            <table class="print-friendly" width="100%" cellpadding="3" cellspacing="0">
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
                        <td colspan="6" align="center" class="record-header">{{$labels['insurance']['insurance']}} {{$i + 1}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="left" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['insurance_type']}}
                        </div>
                        </td>
                        <td colspan="3" align="right" class="underline">
                        <div class="avoid-break">
                            <span style="text-transform: capitalize;">{{isset($insurances[$i]['insurance_type']) ? InsuranceType::find($insurances[$i]['insurance_type'])->getName() : ''}}</span>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['company_name']}}
                        </div>
                        </td>
                        <td align="right" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{{$insurances[$i]['company_name'] or ''}}}
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['number']}}
                        </div>
                        </td>
                        <td align="right" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{isset($insurances[$i]['number']) ? $insurances[$i]['number'] : ''}}
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['plan_type']}}
                        </div>
                        </td>
                        <td align="right" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{{$insurances[$i]['plan_type'] or ''}}}
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['company_phone']}}
                        </div>
                        </td>
                        <td align="right" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{{$insurances[$i]['company_phone']['number'] or ''}}}
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{$labels['insurance']['expiry_date']}}
                        </div>
                        </td>
                        <td align="right" colspan="3" class="underline">
                        <div class="avoid-break">
                            {{isset($insurances[$i]['expiry_date']) ? full_date($insurances[$i]['expiry_date']['year'], $insurances[$i]['expiry_date']['month'], $insurances[$i]['expiry_date']['day']): ''}}
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="left">
                            {{$labels['insurance']['attachment']}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="left" class="underline">
                        @if(isset($insurances[$i]['document']))
                            <?php 
                            $arr = explode(',',$insurances[$i]['document']);
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
                            {{$labels['insurance']['notes']}}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6" align="left" class="underline">
                        <div class="avoid-break">
                            {{isset($insurances[$i]['notes']) ? $insurances[$i]['notes'] : ''}}
                        </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
        @endif
        @if($i&1 && count($insurances) > $i + 1)
        </tr><tr>
        @endif
@endfor
</tr>
@endif