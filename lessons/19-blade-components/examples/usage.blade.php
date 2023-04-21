{{-- How to use the <x-alert> component in any view --}}

<x-alert type="success">Saved successfully.</x-alert>

<x-alert type="error" class="mt-4">
    Something went wrong — please try again.
</x-alert>

{{-- Bind a PHP variable with the colon prefix --}}
<x-alert :type="$level">{{ $message }}</x-alert>
