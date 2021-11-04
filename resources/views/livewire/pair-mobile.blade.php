<div>
    <div class="mb-4 px-4 py-3 leading-normal text-blue-700 bg-blue-100 rounded-lg" role="alert">
        Fill in the form. Choose the region, then province, and cities list will be updated.
    </div>
    <form wire:submit.prevent="storeStation" class="border-b-2 pb-10">
        <div>
            <label class="block font-medium text-sm text-gray-700" for="mobile">
                Mobile*
            </label>
            <input wire:model="mobile" type="text"
                   class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required />
        </div>
        <div>
            <label class="block font-medium text-sm text-gray-700" for="cluster">
                Cluster*
            </label>
            <input wire:model="cluster" type="text"
                   class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required />
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="region">
                Region*
            </label>
            <select wire:model="selectedRegion" name="region"
                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required>
                <option value="">-- choose region --</option>
                @foreach ($regions as $region)
                    <option value="{{ $region->region_code }}">{{ $region->region_description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="province">
                Province*
            </label>

            <select wire:model="selectedProvince" name="province"
                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required>
                @if ($provinces->count() == 0)
                    <option value="">-- choose region first --</option>
                @endif
                <option value="">-- choose province --</option>
                @foreach ($provinces as $province)
                    <option value="{{ $province->province_code }}">{{ $province->province_description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="city">
                City*
            </label>

            <select wire:model="selectedCity" name="city"
                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required>
                @if ($cities->count() == 0)
                    <option value="">-- choose province first --</option>
                @endif
                <option value="">-- choose city --</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->city_municipality_code }}">{{ $city->city_municipality_description }}</option>
                @endforeach
            </select>
        </div>

        <div class="mt-4">
            <label class="block font-medium text-sm text-gray-700" for="barangay">
                Barangay*
            </label>

            <select wire:model="selectedBarangay" name="barangay"
                    class="mt-2 text-sm sm:text-base pl-2 pr-4 rounded-lg border border-gray-400 w-full py-2 focus:outline-none focus:border-blue-400" required>
                @if ($barangays->count() == 0)
                    <option value="">-- choose city first --</option>
                @endif
                    <option value="">-- choose barangay --</option>
                @foreach ($barangays as $barangay)
                    <option value="{{ $barangay->barangay_code }}">{{ $barangay->barangay_description }}</option>
                @endforeach
            </select>
        </div>

        <div class="flex items-center mt-4">
            <button type="submit"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                Pair Mobile
            </button>
        </div>
    </form>

{{--    <h3 class="font-bold text-xl mt-10 mb-5">Latest Companies</h3>--}}

{{--    <table class="min-w-full">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">Name</th>--}}
{{--            <th class="px-6 py-3 border-b-2 border-gray-300 text-left text-sm leading-4 tracking-wider">City</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody class="bg-white">--}}
{{--        @foreach ($companies as $company)--}}
{{--            <tr>--}}
{{--                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $company->name }}</td>--}}
{{--                <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-500 text-sm leading-5">{{ $company->city->name }}, {{ $company->city->state->name }}, {{ $company->city->state->country->name }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
</div>

