{{-- tickets/create.blade.php --}}
<form action="{{ route('tickets.store', $performance->id) }}" method="POST">
    @csrf
    <input type="text" name="buyer_name" placeholder="Your Name" required>
    <input type="email" name="buyer_email" placeholder="Your Email" required>
    <input type="number" name="amount" placeholder="Number of Tickets" required>
    <button type="submit">Checkout</button>
</form>
