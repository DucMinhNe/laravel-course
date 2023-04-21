{{-- resources/views/components/alert.blade.php --}}
{{-- An ANONYMOUS component: no PHP class needed, just props + markup. --}}

@props(['type' => 'info'])

<div {{ $attributes->merge(['class' => "alert alert-{$type}"]) }}>
    {{ $slot }}
</div>
