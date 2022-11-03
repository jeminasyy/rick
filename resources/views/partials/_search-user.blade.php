<form action="/users">
    <div class="relative border-2 border-gray-100 rounded-lg" id="search-div">
        
        <div class="absolute top-4 left-3">
            <i
                class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
            ></i>
        </div>
        <input
            type="text"
            name="search"
            id="search-bar"
            placeholder="Search User..."
        />
        <div class="absolute top-2 right-2">
            <button class="h-10 w-12 text-white rounded-lg bg-red-500 hover:bg-red-600" id="search-submit" type="submit" \>
                <i class='bx bx-search bx-sm bx-fw'></i>
            </button>
        </div>
    </div>
</form>