<div id="smart-keys-set" class="hidden grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label class="flex flex-col w-full">
            <p class="text-white text-base font-medium leading-normal pb-2">Product Title (Smart Key)</p>
            <input class="form-input w-full rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] h-14 placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all" placeholder="Enter the name of the smart key fob" value="" name="title"/>
        </label>
    </div>
    <div class="flex flex-col">
        <p class="text-white text-base font-medium leading-normal pb-2">Price</p>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#92a4c9]">LKR</span>
            <input class="form-input pl-12 w-full rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] h-14 placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all" placeholder="0.00" type="number" value="" name="price"/>
        </div>
    </div>
    <div>
        <label class="flex flex-col w-full">
            <p class="text-white text-base font-medium leading-normal pb-2">Key Brand</p>
            <select class="form-select w-full appearance-none rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] h-14 placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all" name="brand">
                <option>Toyota</option>
                <option>Honda</option>
                <option>Suzuki</option>
                <option>Nisan</option>
                <option>Mazda</option>
                <option>Benz</option>
                <option>Kia</option>
                <option>Hyundai</option>
                <option>BMW</option>
                <option>Mitsubishi</option>
                <option>Ssangyong</option>
                <option>Ford</option>
                <option>BYD</option>
                <option>Other</option>
            </select>
        </label>
    </div>
    <div class="flex flex-col md:col-span-2">
        <p class="text-white text-base font-medium leading-normal pb-2">Stock(Amount)</p>
        <div class="relative">
            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-[#92a4c9]"></span>
            <input class="form-input pl-8 w-full rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] h-14 placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all" placeholder="00" type="number" value="" name="Stock"/>
        </div>
    </div>
    <div class="md:col-span-2">
        <label class="flex flex-col w-full">
            <p class="text-white text-base font-medium leading-normal pb-2">Description</p>
            <textarea class="form-textarea w-full min-h-32 resize-y rounded-lg text-white focus:outline-0 focus:ring-2 focus:ring-primary border border-[#324467] bg-[#101622] placeholder:text-[#92a4c9] p-[15px] text-base font-normal leading-normal transition-all" placeholder="List compatible vehicle models and years..." name="description"></textarea>
        </label>
    </div>
</div>
