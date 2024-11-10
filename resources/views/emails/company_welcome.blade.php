<div style="max-width: 600px; margin: 0 auto; padding: 20px">
  <h2 style="margin-bottom: 20px">Welcome to {{ config('app.name') }}!</h2>

  <p>Hi {{ $data['recipient'] }},</p>

  <p>Thanks for signing up with us! We're excited to have you on board.</p>

  <p>Your login details are:</p>
  <ul style="list-style: none; padding: 0">
    <li>Email: {{ $data['email'] }}</li>
    <li>Password: {{ $data['password'] }}</li>
  </ul>
</div>