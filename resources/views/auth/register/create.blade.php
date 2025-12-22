<x-layouts.auth>
    <x-slot name="title">
        {{ trans('auth.register_user') }} — {{ config('app.name', 'Zap Accounting') }}
    </x-slot>

    <x-slot name="content">
        <div class="flex flex-col items-center text-center">
            <img
                src="{{ asset('public/img/company.png') }}"
                class="w-16 mb-3"
                alt="Zap Accounting"
            />

            <h1 class="text-lg my-3 font-semibold">
                {{ trans('auth.register_user') }} — {{ config('app.name', 'Zap Accounting') }}
            </h1>
        </div>

        <div
            :class="(form.response.success) ? 'w-full bg-green-100 text-green-600 p-3 rounded-sm font-semibold text-xs' : 'hidden'"
            v-if="form.response.success"
            v-html="form.response.message"
            v-cloak
        ></div>

        <div
            :class="(form.response.error) ? 'w-full bg-red-100 text-red-600 p-3 rounded-sm font-semibold text-xs' : 'hidden'"
            v-if="form.response.error"
            v-html="form.response.message"
            v-cloak
        ></div>

        <x-form id="auth" route="register.store">
            <div class="grid sm:grid-cols-6 gap-x-8 gap-y-6 my-3.5 lg:h-64">
                <x-form.input.hidden name="token" value="{{ $token }}" />

                <x-form.group.password
                    name="password"
                    label="{{ trans('auth.password.pass') }}"
                    placeholder="{{ trans('auth.password.pass') }}"
                    form-group-class="sm:col-span-6"
                    input-group-class="in
