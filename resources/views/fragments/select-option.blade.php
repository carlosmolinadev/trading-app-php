<x-select id="{{ $optionName }}" name="{{ $optionName }}">
    <option value=""></option>
    @foreach ($options as $option)
        <option value="{{ $option->id }}" @if ($option->name == old($optionName)) selected="selected" @endif>
            {{ $option->name }}</option>
    @endforeach
</x-select>
