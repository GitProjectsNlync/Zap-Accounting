@props(['companies'])

<x-loading.menu />

<div class="container flex items-center py-3 mb-4 border-b-2 xl:hidden">
    <span class="material-icons text-black js-hamburger-menu">menu</span>

    <div class="flex items-center m-auto">
        <img src="{{ asset('public/img/company.png') }}" class="w-8 m-auto" alt="Zap Accounting" />
        <span class="ltr:ml-2 rtl:mr-2">{{ Str::limit(setting('company.name'), 22) }}</span>
    </div>

    @can('create-banking-transactions')
        <x-dropdown id="dropdown-mobile-actions">
            <x-slot name="trigger">
                <span class="material-icons pointer-events-none">more_horiz</span>
            </x-slot>

            <x-dropdown.link href="{{ route('transactions.create', ['type' => 'income']) }}">
                {{ trans('general.title.new', ['type' => trans_choice('general.incomes', 1)]) }}
            </x-dropdown.link>

            <x-dropdown.link href="{{ route('transactions.create', ['type' => 'expense']) }}" kind="primary">
                {{ trans('general.title.new', ['type' => trans_choice('general.expenses', 1)]) }}
            </x-dropdown.link>
        </x-dropdown>
    @endcan
</div>

@stack('menu_start')

<div
    x-data="{}"
    x-init="() => {
        const loadEvent = 'onpagehide' in window ? 'pageshow' : 'load';
        window.addEventListener(loadEvent, () => {
            $refs.realMenu.classList.remove('hidden');
        });
    }"
    x-ref="realMenu"
    class="w-70 h-screen flex hidden fixed top-0 js-menu z-20 xl:z-10 transition-all ltr:-left-80 rtl:-right-80 xl:ltr:left-0 xl:rtl:right-0"
>
    <div class="w-14 py-7 px-1 bg-lilac-900 z-10 menu-scroll overflow-y-auto overflow-x-hidden">

        {{-- Profile --}}
        <div
            data-tooltip-target="tooltip-profile"
            data-tooltip-placement="right"
            class="flex flex-col items-center justify-center mb-5 cursor-pointer menu-button"
            data-menu="profile-menu"
        >
            @if (setting('default.use_gravatar', '0') == '1')
                <img src="{{ user()->picture }}" class="w-8 h-8 rounded-full" alt="{{ user()->name }}">
            @elseif (is_object(user()->picture))
                <img src="{{ Storage::url(user()->picture->id) }}" class="w-8 h-8 rounded-full" alt="{{ user()->name }}">
            @else
                <span class="material-icons-outlined text-purple w-8 h-8 flex items-center justify-center text-2xl">
                    account_circle
                </span>
            @endif
        </div>

        <div id="tooltip-profile" class="tooltip-base">
            {{ trans('auth.profile') }}
        </div>

        {{-- Toggle Buttons --}}
        <div class="group flex flex-col items-center justify-center menu-toggle-buttons">

            @can('read-notifications')
            <x-tooltip id="tooltip-notifications" placement="right" message="{{ trans_choice('general.notifications', 2) }}">
                <button class="menu-button js-menu-toggles" data-menu="notifications-menu">
                    <span class="material-icons-outlined text-purple">notifications</span>
                </button>
            </x-tooltip>
            @endcan

            <x-tooltip id="tooltip-search" placement="right" message="{{ trans('general.search') }}">
                <button class="menu-button">
                    <span class="material-icons-outlined text-purple">search</span>
                </button>
            </x-tooltip>

            <x-tooltip id="tooltip-new" placement="right" message="{{ trans('general.new') }}">
                <button class="menu-button js-menu-toggles" data-menu="add-new-menu">
                    <span class="material-icons-outlined text-purple">add_circle_outline</span>
                </button>
            </x-tooltip>

            <x-tooltip id="tooltip-settings" placement="right" message="{{ trans_choice('general.settings', 2) }}">
                <button class="menu-button js-menu-toggles" data-menu="settings-menu">
                    <span class="material-icons-outlined text-purple">settings</span>
                </button>
            </x-tooltip>
        </div>

        <livewire:menu.favorites />
    </div>

    {{-- MAIN MENU --}}
    <nav class="menu-list js-main-menu" id="sidenav-main">
        <div class="relative mb-5 cursor-pointer">
            <button type="button" class="flex items-center" data-dropdown-toggle="dropdown-menu-company">
                <div class="w-8 h-8 flex items-center justify-center">
                    <img src="{{ asset('public/img/company.png') }}" class="w-6 h-6" alt="Zap Accounting" />
                </div>

                <span class="ltr:ml-2 rtl:mr-2 truncate w-28">
                    {{ Str::limit(setting('company.name'), 22) }}
                </span>
            </button>

            <div id="dropdown-menu-company" class="dropdown-base hidden">
                @foreach($companies as $com)
                    <x-link href="{{ route('companies.switch', $com->id) }}" class="dropdown-item">
                        {{ Str::limit($com->name, 18) }}
                    </x-link>
                @endforeach

                <x-link href="{{ route('companies.index') }}" class="dropdown-footer">
                    {{ trans('general.title.manage', ['type' => trans_choice('general.companies', 2)]) }}
                </x-link>
            </div>
        </div>

        <div class="main-menu">
            {!! menu('admin') !!}
        </div>
    </nav>

    {{-- Side Menus --}}
    <livewire:menu.profile />
    <livewire:menu.notifications />
    <livewire:menu.settings />
    <livewire:menu.neww />

</div>

@stack('menu_end')
