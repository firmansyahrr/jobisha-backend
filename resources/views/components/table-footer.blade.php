@props([
'perPageRouteName',
'data',
'routeAttribute' => [],
])

<div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
    <nav class="w-full sm:w-auto sm:mr-auto">
        {{-- Pagination Links Start--}}
        {{ $data->links() }}
        {{-- Pagination Links End--}}
    </nav>
    <form id="perPageForm" method="get" action="{{ route($perPageRouteName, $routeAttribute) }}">
        <select class="w-20 form-select box mt-3 sm:mt-0" onchange="document.getElementById('perPageForm').submit()"
            name="per_page" id="tableRow">
            <option value="10" @selected(request()->per_page == 10)>
                {{ __('10') }}
            </option>
            <option value="15" @selected(request()->per_page == 15)>
                {{ __('15') }}
            </option>
            <option value="25" @selected(request()->per_page == 25)>
                {{ __('25') }}
            </option>
            <option value="50" @selected(request()->per_page == 50)>
                {{ __('50') }}
            </option>
        </select>
    </form>
</div>