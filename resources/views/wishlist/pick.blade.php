<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret Christmas Box</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?christmas,lights') no-repeat center center fixed;
            background-size: cover;
        }
        .glow {
            text-shadow: 0 0 10px #ff0000, 0 0 20px #ff0000, 0 0 30px #ff0000, 0 0 40px #ff0000;
        }
        .snowflakes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
        .snowflake {
            position: absolute;
            top: -10px;
            color: white;
            font-size: 1rem;
            user-select: none;
            animation: fall 10s linear infinite;
        }
        @keyframes fall {
            0% { transform: translateY(0) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(360deg); }
        }
    </style>
</head>
<body class="py-10">
    <!-- Snowflake Effect -->
    <div class="snowflakes">
        <div class="snowflake">❄</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
    </div>

    <div class="container mx-auto max-w-4xl text-white">
        <h2 class="text-3xl font-bold mb-8 text-center glow">🎅 Choose Your Secret Christmas Box 🎁</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($users as $user)
                <div id="user-{{ $user->id }}" class="bg-red-500 bg-opacity-80 p-6 rounded-lg shadow-lg border border-red-700">
                    <h3 class="text-lg font-semibold">Name: <span class="text-yellow-300">********</span></h3>
                    <p class="mt-2">Wishlist: <span class="text-yellow-300">********</span></p>
                    <button
                        onclick="pickName({{ $user->id }})"
                        class="mt-4 bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg transition">
                        🎄 Pick Name 🎄
                    </button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div id="modal" class="hidden fixed inset-0 bg-gray-800 bg-opacity-70 flex items-center justify-center z-50">
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 text-gray-800">
            <h3 class="text-lg font-bold mb-4">You Picked:</h3>
            <p id="modalName" class="text-lg font-semibold text-red-600"></p>
            <p id="modalWishlist" class="text-gray-600 mt-2"></p>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-gray-500 text-white py-2 px-4 rounded-lg mr-2">Close</button>
                <a id="downloadLink" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded-lg">Download</a>
            </div>
        </div>
    </div>


    <footer class="text-black text-center text-sm absolute bottom-4 w-full">
        <p>Made with ❤️ by DavtevhStudio & Aderonke</p>
    </footer>
    <script>
        // Add falling snowflakes dynamically
        function createSnowflakes() {
            const container = document.querySelector('.snowflakes');
            for (let i = 0; i < 50; i++) {
                const snowflake = document.createElement('div');
                snowflake.classList.add('snowflake');
                snowflake.textContent = ['❄', '❅', '❆'][Math.floor(Math.random() * 3)];
                snowflake.style.left = Math.random() * 100 + 'vw';
                snowflake.style.animationDuration = Math.random() * 5 + 5 + 's';
                snowflake.style.animationDelay = Math.random() * 5 + 's';
                snowflake.style.fontSize = Math.random() * 1.5 + 1 + 'rem';
                container.appendChild(snowflake);
            }
        }
        createSnowflakes();

        function pickName(userId) {
            fetch(`/pick/${userId}`, {
                method: 'GET',
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Failed to fetch user data.');
                    }
                    return response.json();
                })
                .then((data) => {
                    document.getElementById('modalName').textContent = "Name: " + data.name;
                    document.getElementById('modalWishlist').textContent = "Wishlist: " + data.wishlist;

                    const fileContent = "Name: " + data.name + "\nWishlist: " + data.wishlist;
                    const blob = new Blob([fileContent], { type: 'text/plain' });
                    const url = URL.createObjectURL(blob);
                    const downloadLink = document.getElementById('downloadLink');
                    downloadLink.href = url;
                    downloadLink.download = data.name + "-wishlist.txt";

                    document.getElementById(`user-${userId}`).remove();
                    document.getElementById('modal').classList.remove('hidden');
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }
    </script>
</body>
</html>
