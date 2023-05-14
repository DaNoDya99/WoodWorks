<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>OTP Email Template</title>
    <style>
        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 100% !important;
                padding-left: 20px !important;
                padding-right: 20px !important;
            }
            img[class="logo"] {
                width: 200px !important;
            }
            td[class="content"] {
                padding: 20px !important;
            }
            span[class="otp-code"] {
                font-size: 22px !important;
                letter-spacing: 3px !important;
            }
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f7f7f7; margin: 0; padding: 0;">
<table class="container" cellpadding="0" cellspacing="0" role="presentation" style="display: table; margin: 0 auto; max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 5px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
    <tr>
        <td style="padding: 40px; background-color: #203330; text-align: center;">
            <img class="logo" src="https://i.ibb.co/vz6dVh2/WOODWORKS-min.png" alt="WoodWorks Logo" style="width: 250px;">
        </td>
    </tr>
    <tr>
        <td class="content" style="box-sizing: border-box; padding: 30px; padding-top: 10px;">
            <table cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                <tr>
                    <td>
                        <h1>Verify your login</h1>
                        <p style="color: #555555; font-size: 16px; margin: 0 0 10px;">Please use the following code to activate your account: </p>
                    </td>
                </tr>
                <tr>
                    <td style="text-align: center; padding: 20px 0;">
                        <span class="otp-code" style="display: inline-block; background-color: #f3f3f3; padding: 10px; font-size: 25px; letter-spacing: 5px; color: #333333; border-radius: 5px;"><?= $otpcode ?></span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p style="color: #555555; font-size: 16px; margin: 0 0 10px;">If you didn't request this, you can safely ignore this email.</p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td style="text-align: center; padding: 20px 0;">
            <table cellpadding="0" cellspacing="0" role="presentation" style="width: 100%;">
                <tr>
                    <td class="footer" style="color: #999999; font-size: 12px; margin: 0;">
                        This is an automated email. Please do not reply.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>

</html>