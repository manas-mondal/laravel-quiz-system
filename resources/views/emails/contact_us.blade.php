<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>New Contact Message - Quizify</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f9fafb; margin:0; padding:0;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0"
                    style="background-color:#ffffff; border-radius:10px; padding: 40px; 
                    box-shadow: 0 4px 12px rgba(0,0,0,0.05);">

                    <!-- Header / Logo -->
                    <tr>
                        <td align="center" style="padding-bottom: 20px;">
                            <h1 style="margin:0; color:#22c55e;">Quizify</h1>
                            <p style="color:#6b7280; font-size:14px; margin-top:4px;">
                                New Contact Form Message
                            </p>
                        </td>
                    </tr>

                    <!-- Contact Details -->
                    <tr>
                        <td style="color:#111827; font-size:15px; padding-bottom: 20px;">
                            <p style="margin:6px 0;"><strong>Name:</strong> {{ $msg->name }}</p>
                            <p style="margin:6px 0;"><strong>Email:</strong> {{ $msg->email }}</p>
                        </td>
                    </tr>

                    <!-- Message Content Box -->
                    <tr>
                        <td>
                            <div
                                style="background-color:#f3f4f6; padding:18px; border-radius:8px; 
                                border-left:4px solid #22c55e; font-size:15px; color:#374151;">
                                {{ $msg->message }}
                            </div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding-top: 28px; text-align:center; color:#6b7280; font-size:14px;">
                            <p>Please respond to the user if required.</p>
                            <p>Thanks,<br><strong>Quizify Team</strong></p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>

</html>
