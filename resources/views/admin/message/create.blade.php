<x-layouts.admin>
    <form action="{{ route('admin.message.store') }}" method="POST">
        @csrf
        <div class="w-full flex justify-center items-center">
            <div class="bg-gray-900 text-white rounded-xl px-12 py-6 w-1/2">
                <table class="w-full">
                    <tr>
                        <td><label for="name">Sender Name</label></td>
                        <td><label for="name">:</label></td>
                        <td class="py-3">
                            <input type="text" name="name" id="name" required class="w-full bg-white text-black" placeholder="Enter sender's name">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="email">Email</label></td>
                        <td><label for="email">:</label></td>
                        <td class="py-3">
                            <input type="email" name="email" id="email" required class="w-full bg-white text-black" placeholder="Enter sender's email">
                        </td>
                    </tr>
                    <tr>
                        <td><label for="message">Message</label></td>
                        <td><label for="message">:</label></td>
                        <td class="py-3">
                            <textarea name="message" id="message" required class="w-full bg-white text-black" placeholder="Enter your message"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right py-3">
                            <button type="submit" class="bg-white text-black py-2 px-6 rounded-md hover:bg-gray-800 hover:text-white transition">
                                Add Message
                            </button>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>

    <style>
        table td:nth-child(1) {
            width: 25%;
        }

        table td:nth-child(2) {
            width: 5%;
        }

        table td:nth-child(3) {
            width: 70%;
        }
    </style>
</x-layouts.admin>
