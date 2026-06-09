<!DOCTYPE html>
<html>
<head>
    <title>Login</title>

    @vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100">

<div class="min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">

        <h1 class="text-2xl font-bold text-center mb-6">
            Login
        </h1>

        <form
            action="{{ route('login.process') }}"
            method="POST"
        >
            @csrf

            <div class="mb-4">

                <label class="block mb-2">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-xl p-3"
                    required
                >

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    class="w-full border rounded-xl p-3"
                    required
                >

            </div>

            @if($errors->any())

                <div class="mb-4 text-red-500 text-sm">

                    {{ $errors->first() }}

                </div>

            @endif

            <button
                type="submit"
                class="w-full bg-green-500 text-white py-3 rounded-xl"
            >
                Login
            </button>

        </form>

    </div>

</div>

</body>
</html>