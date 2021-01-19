<tr>
<td>
<table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td class="content-cell" align="center">

    @php
        $json = file_get_contents('http://dominikfrolik.cz/VRS/bot.json');
        $obj = json_decode($json)->bots;
        $randindex = rand(0,count($obj)-1);
    @endphp
    © VRS - Zprávu zaslal: {{$obj[$randindex]}} the bot
</td>
</tr>
</table>
</td>
</tr>
