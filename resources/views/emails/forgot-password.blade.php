<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Password Reset - Quizify</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9fafb; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:10px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Header -->
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="margin:0; color:#22c55e;">Quizify</h1>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding-bottom: 20px; color:#111827; font-size:16px;">
                            <p>Hello <strong>{{ $email }}</strong>,</p>
                            <p>We received a request to reset your password for your account.
                                Please click the button below to securely reset it:</p>
                        </td>
                    </tr>

                    <!-- Reset Password Button -->
                    <tr>
                        <td align="center" style="padding: 30px 0;">
                            <a href="{{ route('user.password.reset', ['token' => $token, 'email' => $email]) }}"
                                style="background-color:#22c55e; color:white; text-decoration:none; 
                                padding:14px 28px; border-radius:6px; font-weight:bold; display:inline-block;">
                                Reset Password
                            </a>
                        </td>
                    </tr>

                    <!-- Expiry Info -->
                    <tr>
                        <td style="color:#374151; font-size:15px; padding-bottom: 20px;">
                            <p>This password reset link will expire in <strong>60 minutes</strong>.</p>
                            <p>If you did not request a password reset, you can safely ignore this email —
                                your account is still secure.</p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="color:#6b7280; font-size:14px; text-align:center; padding-top: 10px;">
                            <p>Thanks,<br><strong>Quizify Team</strong></p>
                            <hr style="border:none; border-top:1px solid #e5e7eb; margin:20px 0;">
                            <p style="font-size:12px; color:#9ca3af;">
                                You’re receiving this email because a password reset was requested for your account.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
