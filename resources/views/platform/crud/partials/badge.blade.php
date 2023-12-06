@php
$textColor =match ($color) {
    'warning', 'light' => 'dark',
    default => 'white',
};
@endphp
<span class="badge text-bg-{{ $color }} text-{{ $textColor }}">{{ $label }}</span>
