<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\{Contact, Station, Barangay, City, Province, Region};

class PairMobile extends Component
{
    public Collection $regions;
    public Collection $provinces;
    public Collection $cities;
    public Collection $barangays;

    public string $mobile;
    public int $cluster;

    public ?string $selectedRegion = null;
    public ?string $selectedProvince = null;
    public ?string $selectedCity = null;
    public ?string $selectedBarangay = null;

    public function mount()
    {
        $this->regions = Region::all();
        $this->provinces = collect();
        $this->cities = collect();
        $this->barangays = collect();
    }

    public function render()
    {
        return view('livewire.pair-mobile', [
            'stations' => Station::with('barangay', 'city.province.region')->latest()->take(5)->get()
        ]);
    }

    public function updatedSelectedRegion($value)
    {
        $this->cities = collect();
        $this->barangays = collect();
        $this->provinces = Province::where('region_code', $value)->get();
        $this->selectedBarangay = null;
        $this->selectedCity = null;
        $this->selectedProvince = null;
    }

    public function updatedSelectedProvince($value)
    {
        if (!is_null($value)) {
            $this->barangays = collect();
            $this->cities = City::where('province_code', $value)->get();
            $this->selectedBarangay = null;
            $this->selectedCity = null;
        }
    }

    public function updatedSelectedCity($value)
    {
        if (!is_null($value)) {
            $this->barangays = Barangay::where('city_municipality_code', $value)->get();
            $this->selectedBarangay = null;
        }
    }

    public function storeStation()
    {
        $this->validate([
            'mobile' => 'required',
            'cluster' => 'required',
            'selectedCity' => 'required',
            'selectedBarangay' => 'required',
        ]);

        $contact = Contact::firstOrCreate([
            'mobile' => $this->mobile,
        ]);

        $station = Station::make([
            'cluster' => $this->cluster,
        ]);

        $city = City::where('city_municipality_code', $this->selectedCity)->first();
        $barangay = Barangay::where('barangay_code', $this->selectedBarangay)->first();

        $station->city()->associate($city);
        $station->barangay()->associate($barangay);
        $station->save();

        $contact->station()->associate($station);
        $contact->save();

        $this->mobile = '';
        $this->cluster = '';
        $this->selectedRegion = null;
        $this->selectedProvince = null;
        $this->selectedCity = null;
        $this->provinces = collect();
        $this->cities = collect();
        $this->barangays = collect();
    }
}
