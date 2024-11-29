<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Christmas Wishlist Form</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background: url('https://source.unsplash.com/1600x900/?christmas,snow') no-repeat center center;
            background-size: cover;
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
<body class="flex justify-center items-center h-screen text-gray-900">
    <!-- Snowflake Effect -->
    <div class="snowflakes">
        <div class="snowflake">❄</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
        <div class="snowflake">❄</div>
        <div class="snowflake">❅</div>
        <div class="snowflake">❆</div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg max-w-md w-full relative">
        <div class="flex justify-center mb-4">
            <img src="" alt="Christmas Icon" class="w-12 h-12">
        </div>
        <h2 class="text-3xl font-bold text-center text-red-600 mb-6">🎄 Christmas Wishlist 🎄</h2>

        @if (session('success'))
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                });
            </script>
        @endif

        <form action="{{ route('wishlist.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">🎅 Your Name</label>
                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" required>
            </div>
            <div>
                <label for="wishlist" class="block text-sm font-medium text-gray-700">🎁 Your Wishlist</label>
                <textarea name="wishlist" id="wishlist" class="mt-1 block w-full p-2 border border-gray-300 rounded-md" rows="4" required></textarea>
            </div>
            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white p-3 rounded-md font-bold transition">Submit</button>
        </form>
    </div>


    <footer class="text-black text-center text-sm absolute bottom-4 w-full">
        <p>Made with ❤️ by DavtevhStudio & Aderonke</p>
    </footer>
    <script>
        // Create additional snowflakes dynamically
        const createSnowflakes = () => {
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
        };
        createSnowflakes();
    </script>
</body>
</html>
