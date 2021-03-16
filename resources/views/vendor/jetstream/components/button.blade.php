<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-default btn-large inline-flex items-center px-4 py-2 uppercase tracking-widest focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
