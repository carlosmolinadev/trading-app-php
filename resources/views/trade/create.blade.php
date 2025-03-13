<x-app-layout>
    <form class="container mx-auto px-8" method="POST" action="{{ route('trade.store') }}">
        @csrf
        <p class="text-xl font-medium my-4">Create Trade</p>
        <div class="grid gap-4 sm:grid-cols-12 ">
            <div class="sm:col-span-3">
                <x-input-label for="exchange" value="Select Exchange" />
                <x-select id="exchange" name="exchange_id" hx-get="{{ route('option.symbol') }}" hx-trigger="change"
                    hx-target="#symbol" hx-swap="outerHTML">
                    <option value=""></option>
                    @foreach ($exchanges as $exchange)
                        <option value="{{ $exchange->id }}"
                            @if ($exchange->id == old('exchange_id')) selected="selected" @endif>
                            {{ $exchange->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('exchange_id')" class="mt-2" />
            </div>

            <div class="sm:col-span-3">
                <x-input-label for="derivate" value="Select Derivate" />
                <x-select id="derivate" name="derivate">
                    <option value=""></option>
                    @foreach ($derivates as $derivate)
                        <option value="{{ $derivate->name }}"
                            @if ($derivate->name == old('derivate')) selected="selected" @endif>
                            {{ $derivate->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('derivate')" class="mt-2" />
            </div>

            <div class="sm:col-span-3">
                <x-input-label for="symbol" value="Select Symbol" />
                <x-select id="symbol" name="symbol">
                    <option value=""></option>
                    @foreach ($symbols as $option)
                        <option value="{{ $option->id }}"
                            @if ($option->id == old('symbol')) selected="selected" @endif>
                            {{ $option->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('symbol')" class="mt-2" />
            </div>

            <div class="sm:col-span-3">
                <x-input-label for="order_type" value="Select Order Type" />
                <x-select id="order_type" name="order_type">
                    <option value=""></option>
                    @foreach ($orderTypes as $option)
                        <option value="{{ $option->id }}"
                            @if ($option->id == old('order_type')) selected="selected" @endif>
                            {{ $option->name }}</option>
                    @endforeach
                </x-select>
                <x-input-error :messages="$errors->get('order_type')" class="mt-2" />
            </div>

            <div class="sm:col-span-6 flex">
                <div class="pr-4 flex-1">
                    <x-input-label for="quantity" value="Quantity" />
                    <x-text-input type="text" id="price" :value="old('quantity')" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
                <div class="flex-1">
                    <x-input-label for="amount" value="Amount" />
                    <x-text-input type="text" id="amount" :value="old('amount')" />
                    <x-input-error :messages="$errors->get('amount')" class="mt-2" />
                </div>
            </div>


            <div class="sm:col-span-3">
                <x-input-label for="price" value="Price" />
                <x-text-input type="text" id="price" :value="old('price')" />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>

            <div class="sm:col-span-3">
                <x-input-label for="order_type" value="Select Trade Setting" />
                <x-select id="order_type" name="order_type">
                    @if (count($tradeSettings) == 0)
                        <option value=""></option>
                    @else
                        @foreach ($tradeSettings as $option)
                            <option value="{{ $option->id }}"
                                @if ($option->id == old('order_type')) selected="selected" @endif>
                                {{ $option->name }}
                            </option>
                        @endforeach
                    @endif
                </x-select>
                <x-input-error :messages="$errors->get('order_type')" class="mt-2" />
            </div>
        </div>

        <div class="flex mt-4 border-t border-red-800">
            <div class="pr-4 mt-4 flex-1">
                <x-input-label for="take_profit" value="Take Profit" />
                <x-text-input type="text" id="take_profit" :value="old('take_profit')" />
                <x-input-error :messages="$errors->get('take_profit')" class="mt-2" />
            </div>
            <div class="flex-1">
                <x-input-label for="stop_loss" value="Stop Loss" />
                <x-text-input type="text" id="stop_loss" :value="old('stop_loss')" />
                <x-input-error :messages="$errors->get('stop_loss')" class="mt-2" />
            </div>
        </div>
        <div class="">
            <x-primary-button type="button">Advanced</x-primary-button>
        </div>
        <x-primary-button type="submit">Submit</x-primary-button>
    </form>
    </div>
</x-app-layout>
