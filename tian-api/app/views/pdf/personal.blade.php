@if((!empty($personal['passports']) && count($personal['passports'])) 
    ||(!empty($personal['social_securities']) && count($personal['social_securities']))
    || !empty($personal['marital_status'])
    || !empty($personal['secondary_email'])
    || !empty($personal['home_phone'])
    || !empty($personal['workplace_phone'])
    || !empty($personal['home_address']) && $personal['home_address'] != ''
    || !empty($personal['workplace_address']) && $personal['workplace_address'] != '')

<tr>
    <td colspan="6">
        <table width="100%">
            <tr>
                <td colspan="6"><h4>{{$title['personal']}}</h4></td>
            </tr>
        </table>
    </td>
</tr>
<tr>
    <td colspan="6">
        <table class="unbreakable" width="100%" cellpadding="3" cellspacing="0">
        <col width="20%">
        <col width="28%">
        <col width="2%">
        <col width="2%">
        <col width="28%">
        <col width="20%">
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
            @if(isset($personal['passports']) && count($personal['passports']))
                <tr>
                @for ($i = 0; $i < count($personal['passports']); $i++)
                     @if (isset($personal['passports'][$i]))
                     @if($i%2 == 0)
                        <td align="left" class="underline">
                            <div class="avoid-break">
                                {{$labels['personal']['passport']}}
                            </div>
                        </td>
                        <td align="right" class="underline">
                            <div class="avoid-break">
                            {{{$personal['passports'][$i]['number'] or ''}}}
                        {{isset($personal['passports'][$i]['nationality']) ?
                          Country::find($personal['passports'][$i]['nationality'])->getName() : ''}}
                            </div>
                        </td>
                        <td colspan="2"></td>
                     @elseif ($i%2 == 1)
                        <td align="left" class="underline">
                            <div class="avoid-break">
                            {{$labels['personal']['passport']}}
                            </div>
                        </td>
                        <td align="right" class="underline">
                           <div class="avoid-break">
                            {{{$personal['passports'][$i]['number'] or ''}}} {{isset($personal['passports'][$i]['nationality']) ?
                          Country::find($personal['passports'][$i]['nationality'])->getName() : ''}}
                          </div>
                        </td>
                     @endif

                     @if ($i%2 == 1 && $i < count($personal['passports']) - 1)
                        </tr><tr>
                     @endif
                     @endif
                @endfor
                </tr>
            @endif
            @if(isset($personal['social_securities']) && count($personal['social_securities']))
                <tr>
                @for ($i = 0; $i < count($personal['social_securities']); $i++)
                     @if (isset($personal['social_securities'][$i]))
                     @if($i%2 == 0)
                        <td align="left" class="underline">
                        <div class="avoid-break">
                            {{$labels['personal']['social_security']}}
                        </div>
                        </td>
                        <td align="right" class="underline">
                        <div class="avoid-break">
                            {{{$personal['social_securities'][$i]['number'] or ''}}}
                        {{isset($personal['social_securities'][$i]['nationality']) ? Country::find($personal['social_securities'][$i]['nationality'])->getName() : ''}}
                        </div>
                        </td>
                        <td colspan="2"></td>
                     @elseif ($i%2 == 1)
                        <td align="left" class="underline">
                        <div class="avoid-break">
                            {{$labels['personal']['social_security']}}
                        </div>
                        </td>
                        <td align="right" class="underline">
                        <div class="avoid-break">
                            {{{$personal['social_securities'][$i]['number'] or ''}}}
                            {{isset($personal['social_securities'][$i]['nationality']) ? Country::find($personal['social_securities'][$i]['nationality'])->getName() : ''}}
                        </div>
                        </td>
                     @endif
                     @if ($i%2 == 1 && $i < count($personal['social_securities']) - 1)
                        </tr><tr>
                     @endif
                @endif
                @endfor
                </tr>           
            @endif
            <tr>
                @if (isset($personal['marital_status']))
                    <td align="left" class="underline">
                        <div class="avoid-break">
                        {{ isset($personal['marital_status']) ? $labels['personal']['marital_status'] : ''}}
                        </div>
                    </td>
                    <td align="right" class="underline">
                        <div class="avoid-break">
                        {{ isset($personal['marital_status']) ? Marital::find($personal['marital_status'])->getName() : ''}}
                        </div>
                    </td>
                <td colspan="2"></td>
                @endif
                @if (isset($personal['secondary_email']) && !empty($personal['secondary_email']))
                    <td align="left" class="underline">
                        <div class="avoid-break">
                        {{isset($personal['secondary_email']) ? $labels['personal']['secondary_email'] : ''}}
                        </div>
                    </td>
                    <td align="right" class="underline">
                        <div class="avoid-break">
                        {{{$personal['secondary_email'] or ''}}}
                        </div>
                    </td>
                @endif
            </tr>
            <tr>
                @if (isset($personal['home_phone']['number']))
                    <td align="left" class="underline">
                        <div class="avoid-break">
                        {{ isset($personal['home_phone']['number']) ? $labels['personal']['home_phone'] : ''}}
                        </div>
                    </td>
                    <td align="right" class="underline">
                        <div class="avoid-break">
                        {{{$personal['home_phone']['number'] or ''}}}
                        </div>
                    </td>
                    <td colspan="2"></td>
                @endif
                @if (isset($personal['workplace_phone']['number']))
                    <td align="left" class="underline">
                        <div class="avoid-break">
                        {{ isset($personal['workplace_phone']['number']) ? $labels['personal']['workplace_phone'] : ''}}
                        </div>
                    </td>
                    <td align="right" class="underline">
                        <div class="avoid-break">
                        {{{$personal['workplace_phone']['number'] or ''}}}
                        </div>
                    </td>
                @endif
            </tr>
            <tr>
                @if (isset($personal['home_address']))
                    <td colspan="2" align="left">
                        <div class="avoid-break">
                        {{ isset($personal['home_address']) ? $labels['personal']['home_address'] : ''}}
                        </div>
                    </td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                @endif
                @if (isset($personal['workplace_address']))                
                    <td colspan="2" align="left">
                        <div class="avoid-break">
                        {{ isset($personal['workplace_address']) ?$labels['personal']['workplace_address'] : ''}}
                        </div>
                    </td>
                @endif
            </tr>
            <tr>
            <div class="avoid-break">
                @if (isset($personal['home_address']))
                    <td colspan="2" align="left" class="underline">
                        <div class="avoid-break">
                        {{{$personal['home_address'] or ''}}}
                        </div>
                    </td>
                    <td colspan="1"></td>
                    <td colspan="1"></td>
                @endif
                @if (isset($personal['workplace_address']))                                
                    <td colspan="2" align="left" class="underline">
                    <div class="avoid-break">
                        {{{$personal['workplace_address'] or ''}}}
                    </div>
                    </td>
                @endif
            </div>
            </tr>
          </tbody>
        </table>
    </td>
</tr>
@endif