<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification - Quizify</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9fafb; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:10px; padding: 40px; box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Header / Logo -->
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="margin:0; color:#22c55e;">Quizify</h1>
                        </td>
                    </tr>

                    <!-- Greeting -->
                    <tr>
                        <td style="padding-bottom: 20px; color:#111827; font-size:16px;">
                            <p>Hello <strong>{{ $user->name }}</strong>,</p>
                            <p>Thank you for signing up! Please verify your email address to activate your account.</p>
                        </td>
                    </tr>

                    <!-- Button -->
                    <tr>
                        <td align="center" style="padding: 30px 0;">
                            <a href="{{ route('user.verify', ['token' => $user->verification_token]) }}"
                                style="background-color:#22c55e; color:white; text-decoration:none; padding:14px 28px; border-radius:6px; font-weight:bold; display:inline-block;">
                                Verify Email Address
                            </a>
                        </td>
                    </tr>

                    <!-- Footer / Info -->
                    <tr>
                        <td style="color:#6b7280; font-size:14px; text-align:center; padding-top: 20px;">
                            <p>If you did not create an account, no action is needed.</p>
                            <p>Thanks,<br><strong>Quizify</strong></p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
