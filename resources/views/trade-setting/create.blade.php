<x-app-layout>
    <form id="form" class="w-2/3 mx-auto" method="post" action={{ route('trade-setting.store') }}>
        {{-- <form id="form" class="w-2/3 mx-auto" hx-post="{{ route('trade-setting.store') }}" hx-target="this"> --}}
        @csrf
        <div class="grid gap-x-8 gap-y-6 mb-2 mt-6 md:grid-cols-2">
            <div>
                <x-input-label for="setting_name" :value="__('Name')" />
                <x-text-input id="setting_name" type="text" name="setting_name" :value="old('setting_name')" required autofocus />
                <x-input-error :messages="$errors->get('setting_name')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="retry_attempt" :value="__('Retry Attempt')" />
                <x-text-input id="retry_attempt" type="text" name="retry_attempt" :value="old('retry_attempt')" />
                <x-input-error :messages="$errors->get('retry_attempt')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="skip_attempt" :value="__('Skip Attempt')" />
                <x-text-input id="skip_attempt" type="text" name="skip_attempt" :value="old('skip_attempt')" />
                <x-input-error :messages="$errors->get('skip_attempt')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="risk_percentage" :value="__('Risk Percentage')" />
                <x-text-input id="risk_percentage" type="text" name="risk_percentage" :value="old('risk_percentage')" />
                <x-input-error :messages="$errors->get('risk_percentage')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="cancel_inactive_order_minutes" :value="__('Cancel Inactive Order (Minutes)')" />
                <x-text-input id="cancel_inactive_order_minutes" type="text" name="cancel_inactive_order_minutes"
                    :value="old('cancel_inactive_order_minutes')" />
                <x-input-error :messages="$errors->get('cancel_inactive_order_minutes')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="stop_loss_setting" :value="__('Stop Loss Setting')" />
                <x-select id="stop_loss_setting">
                    <option selected></option>
                    @foreach ($data['stopLossOptions'] as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </x-select>
            </div>

            <div>
                <x-input-label for="stop_loss_setting_value" :value="__('Stop Loss Setting Value')" />
                <x-text-input x-ref="stopLossSettingValue" id="stop_loss_setting_value" name="stop_loss_setting"
                    type="text" />
                <x-input-error :messages="$errors->get('stop_loss_setting_value')" class="mt-2" />
            </div>

            <div>
                <label for="stop_loss_setting" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stop
                    Loss Setting</label>
                <select id="stop_loss_setting"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected></option>
                    @foreach ($data['stopLossOptions'] as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <x-input-label for="take_profit_setting_value" :value="__('Take Profit Setting Value')" />
                <x-text-input x-ref="takeProfitSettingValue" id="take_profit_setting_value" name="take_profit_setting"
                    type="text" />
                <x-input-error :messages="$errors->get('take_profit_setting_value')" class="mt-2" />
            </div>
        </div>

        <button type="submit"
            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        <button hx-post="{{ route('trade-setting.store') }}" hx-target="#form">Here</button>
    </form>
    </div>
</x-app-layout>
