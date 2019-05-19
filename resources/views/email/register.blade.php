<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Confirmation</title>
</head>
<body>
    <div width="100%" bgcolor="#f6f9fc" style="margin:0;">
        <table cellpadding="0" cellspacing="0" border="0" height="100%" width="100%" bgcolor="#f6f9fc" style="border-collapse:collapse">
        <tbody>
        <tr>
        <td style="height:4px;font-size:4px;line-height:4px" bgcolor="#ed015a">&nbsp;</td>
        </tr>
        <tr>
        <td valign="top">
        <center style="width:100%">
        <div style="max-width:680px">
        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:680px">
        <tbody>
        <tr>
        <td style="padding:20px 0;text-align:center">
        <a href="{{url('/')}}" target="_blank">
        <img src="{{ asset('img/v-logo.png') }}" width="110" height="130" border="0">
        </a>
        </td>
        </tr>
        </tbody>
        </table>
        <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="100%" style="max-width:680px">
        <tbody>
        <tr>
        <td bgcolor="#ffffff" align="center" height="100%" valign="top" width="100%" style="border-top:1px solid #f6f9fc">
        <table border="0" cellpadding="0" cellspacing="0" align="center" width="100%" style="max-width:660px">
        <tbody>
        <tr>
        <td>
        <table cellspacing="0" cellpadding="0" border="0" width="100%">
        <tbody>
        <tr>
        <td style="padding:30px 15px;font-family:sans-serif;font-size:16px;line-height:1.5;color:#555555"><span style="color:#555555;">
        Hai, terimakasih telah mendaftarkan diri anda dalam acara BeautyClass. Silahkan melakukan konfirmasi email dengan menekan tombol dibawah ini agar data anda dapat kami proses.</span><br><br><br><span style="color:#555555;">
            <div style="text-align: center"><a style="padding: 12px 20px; background-color: #ed015a; color: #fff; text-decoration: none; border-radius: 5px;" href="{{url('/verify/'.$user->token.'/'.$user->id)}}">Verifikasi Email</a></div>
        </span><br><br>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
        <table cellspacing="0" cellpadding="0" border="0" align="center" width="100%" style="max-width:680px">
        <tbody>
        <tr>
        <td style="padding:40px 10px;width:100%;font-size:12px;font-family:sans-serif;line-height:18px;text-align:center;color:#9ea4ac"> BeautyClass
        <br>
        <span>&copy; All Right Reserved</span>
        <br>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        </center>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</body>
</html>