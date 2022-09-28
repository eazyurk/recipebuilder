@props([
    'route' => '',
    'title' => '',
])

<!-- Current: "", Default: "" -->

<a href="{{ route($route) }}"
   @class([
       'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium',
       'border-primary-500 text-gray-900' => Route::currentRouteName() === $route,
        'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700' => Route::currentRouteName() !== $route
   ])
   aria-current="page">
    {{ $title }}
</a>

<!-- mobile route -->
<a href="{{ route($route) }}"
   @class([
       'block pl-3 pr-4 py-2 border-l-4 text-base font-medium sm:hidden',
       'bg-primary-50 border-primary-500 text-primary-700' => Route::currentRouteName() === $route,
        'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800' => Route::currentRouteName() !== $route
   ])
   aria-current="page">
    {{ $title }}
</a>
