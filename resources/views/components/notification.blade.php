@foreach (['success', 'warning', 'danger'] as $type)
<x-buk-alert :type="$type" class="leading-5 text-md">
  @if ($type === 'warning')
  <div class="flex items-center p-4 text-yellow-600 bg-yellow-100 rounded-md">
    <div class="heroicon-icon">
      <x-heroicon-o-exclamation-circle class="w-7 h-7" />
    </div>
    <div class="flex-grow ml-4">
      {{ $component->message() }}
    </div>
  </div>
  @elseif ($type === 'danger')
  <div class="flex items-center p-4 text-red-600 bg-red-100 rounded-md">
    <div class="heroicon-icon">
      <x-heroicon-o-x-circle class="w-7 h-7" />
    </div>
    <div class="flex-grow ml-4">
      {{ $component->message() }}
    </div>
  </div>
  @else
  <div class="flex items-center p-4 text-green-600 bg-green-100 rounded-md">
    <div class="heroicon-icon">
      <x-heroicon-o-check-circle class="w-7 h-7" />
    </div>
    <div class="flex-grow ml-4">
      {{ $component->message() }}
    </div>
  </div>
  @endif
</x-buk-alert>
@endforeach