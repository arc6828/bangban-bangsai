<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}


    <div style="text-align: center">
        <button wire:click="increment">+</button>
        <h1>{{ $count }}</h1>
    </div>
    <div>
        <select id="input_province" wire:model="province_value" wire:change="onProvinceChanged">
            <option value="">กรุณาเลือกจังหวัด</option>
            @foreach($provinces as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <select id="input_amphoe" wire:model="amphoe_value" wire:change="onAmphoeChanged">
            <option value="">กรุณาเลือกเขต/อำเภอ</option>
            @foreach($amphoes as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <select id="input_tambon"  wire:model="district_value" wire:change="onDistrictChanged">
            <option value="">กรุณาเลือกแขวง/ตำบล</option>
            @foreach($districts as $item)
            <option value="{{ $item }}">{{ $item }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <input id="input_zipcode" placeholder="รหัสไปรษณีย์" wire:model="zipcode"   />
    </div>

</div>