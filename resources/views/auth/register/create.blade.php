<x-layouts.auth>
    <x-slot name="title">
        {{ trans('auth.register_user') }} — {{ config('app.name', 'Zap Accounting') }}
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-col items-center text-center">
            <img
                src="{{ asset('public/img/company.png') }}"
                class="w-16 mb-3"
                alt="{{ config('app.name', 'Zap Accounting') }}"
            />

            <h1 class="text-lg my-3 font-semibold">
                {{ trans('auth.register_user') }} — {{ config('app.name', 'Zap Accounting') }}
            </h1>
        </div>

        {{-- Success Message --}}
        <div
            v-if="form.response.success"
            v-html="form.response.message"
            v-cloak
            :class="form.response.success
                ? 'w-full bg-green-100 text-green-700 p-3 rounded-sm font-semibold text-xs'
                : 'hidden'"
        ></div>

        {{-- Error Message --}}
        <div
            v-if="form.response.error"
            v-html="form.response.message"
            v-cloak
            :class="form.response.error
                ? 'w-full bg-red-100 text-red-700 p-3 rounded-sm font-semibold text-xs'
                : 'hidden'"
        ></div>

        <x-form id="auth" route="register.store">
            <div class="grid sm:grid-cols-6 gap-x-8 gap-y-6 my-4 lg:h-64">
                <x-form.input.hidden name="token" value="{{ $token }}" />

                <x-form.group.password
                    name="password"
                    label="{{ trans('auth.password.pass') }}"
                    placeholder="{{ trans('auth.password.pass') }}"
                    form-group-class="sm:col-span-6"
                    input-group-class="input-group-alternative"
                />

                <x-form.group.password
                    name="password_confirmation"
                    label="{{ trans('auth.password.pass_confirm') }}"
                    placeholder="{{ trans('auth.password.pass_confirm') }}"
                    form-group-class="sm:col-span-6"
                    input-group-class="input-group-alternative"
                />

                <x-button
                    type="submit"
                    ::disabled="form.loading"
                    class="relative flex items-center justify-center bg-green hover:bg-green-700 text-white px-6 py-2 text-base rounded-lg disabled:bg-green-100 sm:col-span-6"
                    override="class"
                    data-loading-text="{{ trans('general.loading') }}"
                >
                    <x-button.loading>
                        {{ trans('auth.register') }}
                    </x-button.loading>
                </x-button>
            </div>
        </x-form>
    </x-slot>

    <x-script folder="auth" file="common" />
</x-layouts.auth>
