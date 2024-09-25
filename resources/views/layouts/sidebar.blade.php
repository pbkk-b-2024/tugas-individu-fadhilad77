<aside class="w-64 bg-white shadow-md">
    <div class="p-4">
        <h2 class="text-2xl font-semibold mb-4 text-gray-800">Menu</h2>
        <ul>
            @can('viewAny', App\Models\User::class)
            <li class="mb-2">
                <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out" onclick="toggleDropdown('membersDropdown')">Members</a>
                <ul id="membersDropdown" class="ml-4 hidden">
                    <li class="mb-2">
                        <a href="{{ route('members.index') }}" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">Users</a>
                    </li>
                    <li class="mb-2">
                        <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">Friends</a>
                    </li>
                </ul>
            </li>   
            @endcan

            <li class="mb-2">
                <a href="#" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out" onclick="toggleDropdown('photographyDropdown')">Photography</a>
                <ul id="photographyDropdown" class="ml-4 hidden">
                    <li class="mb-2">
                        <a href="{{ route('photography.photos.index') }}" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">Photos</a>
                    </li>
                    <li class="mb-2">
                        <a href="/photography/albums" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">Albums</a>
                    </li>
                    <li class="mb-2">
                        <a href="/photography/categories" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">Categories</a>
                    </li>
                </ul>
            </li>

            <li class="mb-2">
                <a href="" class="block text-gray-600 hover:bg-gray-100 px-4 py-2 rounded transition duration-150 ease-in-out">API</a>
            </li>
        </ul>
    </div>
</aside>

<script>
    function toggleDropdown(id) {
        var element = document.getElementById(id);
        if (element.classList.contains('hidden')) {
            element.classList.remove('hidden');
        } else {
            element.classList.add('hidden');
        }
    }
</script>