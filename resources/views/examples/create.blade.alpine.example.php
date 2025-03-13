<x-app-layout>
    <div x-data="formData()">
        <form id="form" class="w-2/3 mx-auto" hx-post={{ route('trade-setting.store') }} hx-select="#form"
            hx-swap="outerHTML">
            @csrf
            <div class="grid gap-x-8 gap-y-6 mb-2 mt-6 md:grid-cols-3">
                <div>
                    <label for="setting_name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                    <input type="text" name="setting_name" id="setting_name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="retry_attempt"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retry
                        Attempt</label>
                    <input type="text" name="retry_attempt"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="skip_attempt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Skip
                        Attempt</label>
                    <input type="text" name="skip_attempt"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="risk_percentage"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Risk
                        Percentage</label>
                    <input type="text" name="risk_percentage"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <label for="cancel_inactive_order_minutes"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cancel
                        Inactive Order (Minutes)
                    </label>
                    <input type="text" name="cancel_inactive_order_minutes" id="cancel_inactive_order_minutes"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
                <div>
                    <div class="flex flex-col">
                        <div>
                            <input id="open_order_setting" type="checkbox" x-bind:checked="openOrderSetting"
                                x-on:click="toggleOpenOrder()"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="open_order_setting"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Open Order
                                Setting</label>
                        </div>
                        <div>
                            <input id="stop_loss_setting" type="checkbox" x-bind:checked="stopLossSetting"
                                x-on:click="stopLossSetting = !stopLossSetting"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="stop_loss_setting"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Stop Loss
                                Setting</label>
                        </div>
                        <div>
                            <input id="take_profit_setting" type="checkbox" x-bind:checked="takeProfitSetting"
                                x-on:click="takeProfitSetting = !takeProfitSetting"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="stop_loss_setting"
                                class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Take Profit
                                Setting</label>
                        </div>
                    </div>
                </div>
                <div x-cloak x-show="openOrderSetting">
                </div>
                <div x-cloak x-show="stopLossSetting">
                    <label for="stop_loss_setting"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stop Loss
                        Setting</label>
                    <select id="stop_loss_setting"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected></option>
                        @foreach ($data['stopLossOptions'] as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div x-cloak x-show="stopLossSetting">
                    <label for="stop_loss_setting_value"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Stop Loss Setting Value</label>
                    <input x-ref="stopLossSettingValue" type="text" name="stop_loss_setting"
                        id="stop_loss_setting_value"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>

                <div x-cloak x-show="takeProfitSetting">
                    <label for="take_profit_setting"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Take Profit
                        Setting</label>
                    <select id="take_profit_setting"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected></option>
                        @foreach ($data['takeProfitOptions'] as $name)
                        <option value="{{ $name }}">{{ $name }}</option>
                        @endforeach
                    </select>
                </div>
                <div x-cloak x-show="takeProfitSetting">
                    <label for="stop_loss_setting_value"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Take Profit Setting Value</label>
                    <input x-ref="stopLossSettingValue" type="text" name="stop_loss_setting"
                        id="stop_loss_setting_value"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                </div>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

    </div>
    <script>
        function formData() {
            return {
                openOrderSetting: false,
                stopLossSetting: false,
                takeProfitSetting: false,
                toggleOpenOrder() {
                    this.openOrderSetting = !this.openOrderSetting;
                }
            };
        }
    </script>
</x-app-layout>


{{-- <div x-data="{
    retryAttempts: [],
    addRetryAttempt() {
        this.retryAttempts.push('');
    }
}">
    <template x-for="(attempt, index) in retryAttempts" x-bind:key="index">
        <div>
            <label x-bind:for="'retry_attempt_' + index"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Retry Attempt</label>
            <input type="text" x-bind:name="'retry_attempts[' + index + ']'"
                x-bind:id="'retry_attempt_' + index" x-model="retryAttempts[index]"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
        </div>
    </template> --}}