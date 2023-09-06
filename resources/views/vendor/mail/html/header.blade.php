@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'HugoRaak')
<img src="http://localhost:8000/storage/images/logo_border.png" class="logo" alt="HugoRaak Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
