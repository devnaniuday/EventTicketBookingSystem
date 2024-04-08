<!-- verify-otp.blade.php -->
<form action="{{ route('verify-otp') }}" method="POST">
    @csrf
    <input type="text" name="otp" placeholder="Enter OTP">
    <button type="submit">Verify OTP</button>
</form>
