<!-- resources/views/components/button.blade.php -->
<button {{ $attributes->merge(['class'=>'font-bold py-2 px-4 rounded']) }}>
    {{ $slot }}
</button>