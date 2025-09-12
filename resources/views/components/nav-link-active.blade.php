@props(['active' => false])

<a class="{{ $active ? 'bg-blue-600 text-white' : 'text-blue-600 hover:bg-blue-400 hover:text-white' }} rounded-md px-3 py-2 text-sm font-semibold" aria-current="{{ $active ? 'page' : false }}" {{ $attributes }}>{{ $slot }}</a>