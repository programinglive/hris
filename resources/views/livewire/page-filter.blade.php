<div class="flex flex-wrap justify-between items-center gap-4 md:gap-6">
    <div class="w-full">
        <div class="relative float-right flex gap-4">
            <select
              wire:model.lazy="companyCode"
              class="block w-full rounded-md bg-gray-50 border border-gray-300
                text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700
                dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400
                dark:focus:ring-gray-600 dark:focus:border-gray-600
            " @if(!$filter) disabled @endif>
                @if($filter)
                <option value="all">All Company</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->code }}">{{ $company->name }}</option>
                @endforeach
                @endif
            </select>
            
            @if($branchFilter && $companyId)
            <select
              wire:model.live="brandCode"
              class="block w-full rounded-md bg-gray-50 border border-gray-300
                text-gray-900 focus:border-gray-500 focus:ring-gray-500 dark:bg-gray-700
                dark:border-gray-600 dark:placeholder-gray-400 dark:text-gray-400
                dark:focus:ring-gray-600 dark:focus:border-gray-600
            " @if(!$filter) disabled @endif>
                @if($filter)
                <option value="">All Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->code }}">{{ $brand->name }}</option>
                @endforeach
                @endif
            </select>
            @endif
        </div>
    </div>
</div>