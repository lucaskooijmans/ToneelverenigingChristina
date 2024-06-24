@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<header>
    <img src="cid:logo.jpg" alt="Custom Logo">
</header>

@else
{{ $slot }}
@endif
</a>
</td>
</tr>
