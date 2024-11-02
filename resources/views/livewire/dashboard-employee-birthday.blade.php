<div class="flex flex-col bg-white p-6 rounded-lg shadow gap-2">
  <h3 class="text-xl">This month's birthday</h3>
  <ul class="list-disc list-inside">
    @foreach ($employees as $employee)
      <li class="flex items-center gap-2 bg-red-400 text-white p-1">
        <i class="fa fa-birthday-cake text-yellow-500 mr-2"></i>
        <span class="font-semibold">{{ $employee->first_name }} ({{ $employee->nik }})</span>
        <span class="text-sm">({{ $employee->date_of_birth->format('F j') }})</span>
      </li>
    @endforeach
  </ul>
</div>