@if($hasOrgan)
<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td class="sub-topic"  align="left"><h5>{{$title['organ_donor_status']}}</h5></td>
            </tr>
        </table>
    </td>    
</tr>
<tr>
    <td colspan="3">
        <table width="100%" cellpadding="3" cellspacing="0">
            <thead>
                <tr>
                    <th width="40%"></th>
                    <th width="60%"></th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td align="left" class="underline">
                <div class="avoid-break">
                {{$labels['medical']['organ_donor']['status']}}
                </div>
                </td>
                <td align="right" class="underline">
                <div class="avoid-break">
                {{ isset($medical['organ_donor']['status']) ? OrganDonorStatus::find($medical['organ_donor']['status'])->getStatus() : '' }}
                </div>
                </td>
            </tr>
            <tr>
                <td align="left" class="underline">
                <div class="avoid-break">
                {{$labels['medical']['organ_donor']['condition']}}
                </div>
                </td>
                <td align="right" class="underline">
                <div class="avoid-break">
                {{ isset($medical['organ_donor']['condition']) ? OrganDonorCondition::find($medical['organ_donor']['condition'])->getName() : '' }}
                </div>
                </td>
            </tr>
            @if(isset($medical['organ_donor']['card']))
            <tr>
                <td colspan="2" align="left">{{$labels['medical']['organ_donor']['card']}}</td>
            </tr>
            <tr>
                <td colspan="2" align="left" class="underline" style="font-size: x-small;">
                    <?php 
                        $arr = explode(',',$medical['organ_donor']['card']);
                        foreach($arr as $val_new){
                            echo '<a target="_blank" href="'.$val_new.'">'.$val_new.'</a><br>';
                        }
                    ?>
                </td>
            </tr>
            @endif
            <tr>
                <td colspan="2" align="left">{{$labels['medical']['organ_donor']['note']}}</td>
            </tr>
            <tr>
                <td colspan="2" align="left" class="underline">
                <div class="avoid-break">
                {{{$medical['organ_donor']['notes'] or ''}}}
                </div>
                </td>
            </tr>
        </table>
    </td>
</tr>
@endif