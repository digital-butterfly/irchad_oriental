<style>

    /* What it does: Remove spaces around the email design added by some email clients. */
    /* Beware: It can remove the padding / margin and add a background color to the compose a reply window. */
    html,
    body {
        margin: 0 auto !important;
        padding: 0 !important;
        height: 100% !important;
        width: 100% !important;
        background: #f1f1f1;
    }

    /* What it does: Stops email clients resizing small text. */
    * {
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%;
    }

    /* What it does: Centers email on Android 4.4 */
    div[style*="margin: 16px 0"] {
        margin: 0 !important;
    }

    /* What it does: Stops Outlook from adding extra spacing to tables. */
    table,
    td {
        mso-table-lspace: 0pt !important;
        mso-table-rspace: 0pt !important;
    }

    /* What it does: Fixes webkit padding issue. */
    table {
        border-spacing: 0 !important;
        border-collapse: collapse !important;
        table-layout: fixed !important;
        margin: 0 auto !important;
    }

    /* What it does: Uses a better rendering method when resizing images in IE. */
    img {
        -ms-interpolation-mode:bicubic;
    }

    /* What it does: Prevents Windows 10 Mail from underlining links despite inline CSS. Styles for underlined links should be inline. */
    a {
        text-decoration: none;
    }

    /* What it does: A work-around for email clients meddling in triggered links. */
    *[x-apple-data-detectors],  /* iOS */
    .unstyle-auto-detected-links *,
    .aBn {
        border-bottom: 0 !important;
        cursor: default !important;
        color: inherit !important;
        text-decoration: none !important;
        font-size: inherit !important;
        font-family: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
    }

    /* What it does: Prevents Gmail from displaying a download button on large, non-linked images. */
    .a6S {
        display: none !important;
        opacity: 0.01 !important;
    }

    /* What it does: Prevents Gmail from changing the text color in conversation threads. */
    .im {
        color: inherit !important;
    }

    /* If the above doesn't work, add a .g-img class to any image in question. */
    img.g-img + div {
        display: none !important;
    }

    /* What it does: Removes right gutter in Gmail iOS app: https://github.com/TedGoas/Cerberus/issues/89  */
    /* Create one of these media queries for each additional viewport size you'd like to fix */

    /* iPhone 4, 4S, 5, 5S, 5C, and 5SE */
    @media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
        u ~ div .email-container {
            min-width: 320px !important;
        }
    }
    /* iPhone 6, 6S, 7, 8, and X */
    @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
        u ~ div .email-container {
            min-width: 375px !important;
        }
    }
    /* iPhone 6+, 7+, and 8+ */
    @media only screen and (min-device-width: 414px) {
        u ~ div .email-container {
            min-width: 414px !important;
        }
    }


</style>

<!-- CSS Reset : END -->

<!-- Progressive Enhancements : BEGIN -->
<style>

    .bg_white{
        background: #ffffff;
    }




    h1,h2,h3,h4,h5,h6{
        font-family: 'Poppins', sans-serif;
        color: #000000;
        margin-top: 0;
        font-weight: 400;
    }

    body{
        font-family: 'Poppins', sans-serif;
        font-weight: 400;
        font-size: 15px;
        line-height: 1.8;
        color: rgba(0,0,0,.4);
    }

    a{
        color: #17bebb;
    }

    table{
    }
    /*LOGO*/

    .logo h1{
        margin: 0;
    }
    .logo h1 a{
        color: #17bebb;
        font-size: 24px;
        font-weight: 700;
        font-family: 'Poppins', sans-serif;
    }

    /*HERO*/
    .hero{
        position: relative;
        z-index: 0;
    }

    .hero .text{
        color: rgba(0,0,0,.3);
    }
    .hero .text h2{
        color: #000;
        font-size: 34px;
        margin-bottom: 0;
        font-weight: 200;
        line-height: 1.4;
    }
    .hero .text h3{
        font-size: 24px;
        font-weight: 300;
    }
    .hero .text h2 span{
        font-weight: 600;
        color: #000;
    }

    .text-author{
        bordeR: 1px solid rgba(0,0,0,.05);
        max-width: 80%;
        margin: 0 auto;
        padding: 2em;
    }




    @media screen and (max-width: 500px) {


    }


</style>


</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
<center style="width: 100%; background-color: #f1f1f1;">

    <div style="max-width: 800px; margin: 0 auto;" class="email-container">
        <!-- BEGIN BODY -->
        <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
            <tr>
                <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td class="logo" style="text-align: center; ">
                                <h1><a href="#">
                                        <svg width="150" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Calque_1" x="0px" y="0px" viewBox="-4.6 1113.8 1609.1 489.2" enable-background="new -4.6 1113.8 1609.1 489.2" xml:space="preserve">
<g>
    <path fill="#0969C9" d="M256,1320.2c0,30.9-24.9,55.8-55.8,55.8s-55.8-24.9-55.8-55.8c0-30.9,24.9-55.8,55.8-55.8   S256,1289.3,256,1320.2"/>
    <path fill="#5ABA77" d="M225.8,1234.1c30.6,9,54.2,33.6,61.8,64.8l88.1-151.9L225.8,1234.1"/>
    <rect x="523.2" y="1222.1" fill="#0969C9" width="47.2" height="322.1"/>
    <path fill="#0969C9" d="M698.6,1222.1c26.3,0,45.5,7.3,57.8,22.3c11,13,16.3,31.2,16.3,54.5v46.9c0,22.9-8.3,42.2-25.3,57.8   l34.9,140.6h-50.8l-28.6-121.7c-1.3,0-2.7,0.3-4.3,0.3h-26.9v121.3h-47.2v-322H698.6z M726.9,1299.9c0-18.6-9-27.9-26.9-27.9h-28.2   v103.1H700c7.6,0,14-2.7,18.9-8.3c5.3-5.3,7.6-12,7.6-19.6V1300L726.9,1299.9L726.9,1299.9z"/>
    <path fill="#0969C9" d="M901.7,1548.2c-20.9,0-38.5-7.3-52.8-22.3c-14.6-15-21.6-32.9-21.6-54.5v-176.5c0-21.3,7.3-39.6,21.9-54.5   c14.6-15,32.2-22.6,52.8-22.6c20.9,0,38.5,7.6,52.8,22.6s21.6,33.2,21.6,54.5v36.6h-48.8v-37.2c0-7.6-2.7-14.3-8-19.9   c-5.3-5.3-11.6-8.3-19.3-8.3c-7.3,0-13.6,2.7-18.9,8.3c-5.3,5.3-8,12-8,19.9v176.9c0,7.6,2.7,14.3,8,19.6c5.3,5.3,11.6,8,18.9,8   c7.6,0,14-2.7,19.3-8c5.3-5.3,8-12,8-19.6v-44.5h48.8v44.7c0,21.3-7.3,39.6-21.9,54.5C939.9,1540.9,922.3,1548.2,901.7,1548.2z"/>
    <polygon fill="#0969C9" points="1074.1,1408 1074.1,1544.3 1027.3,1544.3 1027.3,1222.1 1074.1,1222.1 1074.1,1359.1 1131,1359.1    1131,1222.1 1177.8,1222.1 1177.8,1544.3 1131,1544.3 1131,1408  "/>
    <path fill="#0969C9" d="M1290.5,1470.1l-11.6,74.1h-48.8l52.8-322.1h64.8l52.2,322.1h-49.2l-11.3-74.1L1290.5,1470.1L1290.5,1470.1   z M1315.1,1295.9l-17.6,127h34.9L1315.1,1295.9z"/>
    <path fill="#0969C9" d="M1600.2,1467.1c0,21.3-7.3,39.2-21.6,54.5c-14.6,15-31.9,22.6-52.2,22.6h-74.1v-322.1h74.1   c20.6,0,37.9,7.6,52.5,22.6c14.3,15,21.6,33.2,21.6,54.2v168.2H1600.2z M1499.1,1496h28.2c7.6,0,14-2.7,18.9-8.3   c5-5.7,7.6-12.3,7.6-19.6v-168.5c0-7.6-2.7-14.3-8-19.6c-5.3-5.3-11.6-8.3-18.9-8.3h-28.2v224.4h0.4V1496z"/>
    <path fill="#0961AA" d="M334.8,1539.6l-41.2-91.4c-11-24.3-50.2-41.9-93.4-41.9s-82.4,17.6-93.4,41.6l-41.2,91.8   c-4.7,10.3-3.7,15.6,2.7,25.6c14.3,21.9,50.5,31.2,90.7,31.2h82.4c39.9,0,76.4-9.3,90.7-31.2   C338.4,1555.2,339.4,1550.2,334.8,1539.6"/>
    <path fill="#0969C9" d="M256,1320.2c0,30.9-24.9,55.8-55.8,55.8s-55.8-24.9-55.8-55.8c0-30.9,24.9-55.8,55.8-55.8   S256,1289.3,256,1320.2"/>
    <path fill="#0969C9" d="M199.9,1376L199.9,1376L199.9,1376 M199.9,1376L199.9,1376L199.9,1376 M199.5,1376L199.5,1376L199.5,1376    M199.5,1376L199.5,1376L199.5,1376 M199.2,1376L199.2,1376L199.2,1376 M198.9,1376C198.9,1376,199.2,1376,198.9,1376   C199.2,1376,198.9,1376,198.9,1376 M198.9,1376L198.9,1376L198.9,1376 M198.5,1376L198.5,1376L198.5,1376 M198.5,1376L198.5,1376   L198.5,1376 M198.2,1376L198.2,1376L198.2,1376 M197.9,1376L197.9,1376L197.9,1376 M197.9,1376L197.9,1376L197.9,1376 M197.5,1376   L197.5,1376L197.5,1376 M197.5,1376L197.5,1376L197.5,1376 M197.2,1376L197.2,1376L197.2,1376 M196.6,1376L196.6,1376L196.6,1376    M196.6,1376L196.6,1376L196.6,1376 M196.2,1376L196.2,1376L196.2,1376 M195.9,1376L195.9,1376L195.9,1376 M256,1320.2L256,1320.2   L256,1320.2L256,1320.2 M256,1319.9L256,1319.9L256,1319.9 M256,1319.9L256,1319.9L256,1319.9 M256,1319.5L256,1319.5L256,1319.5    M256,1319.2C256,1319.5,256,1319.5,256,1319.2C256,1319.5,256,1319.5,256,1319.2 M256,1319.2L256,1319.2L256,1319.2 M256,1318.9   C256,1318.9,256,1319.2,256,1318.9C256,1319.2,256,1318.9,256,1318.9 M256,1318.9L256,1318.9L256,1318.9 M256,1318.5L256,1318.5   L256,1318.5 M256,1318.2L256,1318.2L256,1318.2 M256,1318.2L256,1318.2L256,1318.2 M256,1317.9L256,1317.9L256,1317.9 M256,1317.9   L256,1317.9L256,1317.9 M256,1317.5L256,1317.5L256,1317.5 M256,1317.2C256,1317.5,256,1317.5,256,1317.2   C256,1317.5,256,1317.5,256,1317.2 M256,1317.2L256,1317.2L256,1317.2 M256,1316.5v0.3C256,1316.9,256,1316.9,256,1316.5    M256,1316.5L256,1316.5L256,1316.5 M256,1316.2C256,1316.2,256,1316.5,256,1316.2C256,1316.5,256,1316.2,256,1316.2 M256,1316.2   L256,1316.2L256,1316.2 M256,1315.9L256,1315.9L256,1315.9 M256,1315.9L256,1315.9L256,1315.9 M256,1315.5L256,1315.5L256,1315.5    M256,1315.2C256,1315.2,256,1315.5,256,1315.2C256,1315.5,256,1315.2,256,1315.2 M256,1315.2L256,1315.2L256,1315.2 M256,1314.9   L256,1314.9L256,1314.9 M256,1314.9L256,1314.9L256,1314.9 M256,1314.5L256,1314.5L256,1314.5 M255.7,1314.2   C256,1314.5,256,1314.5,255.7,1314.2C256,1314.5,256,1314.5,255.7,1314.2 M255.7,1314.2L255.7,1314.2L255.7,1314.2 M255.7,1313.9   L255.7,1313.9L255.7,1313.9 M255.7,1313.9L255.7,1313.9L255.7,1313.9 M255.7,1313.5L255.7,1313.5L255.7,1313.5 M255.7,1313.2   C255.7,1313.5,255.7,1313.5,255.7,1313.2C255.7,1313.5,255.7,1313.5,255.7,1313.2 M255.7,1313.2L255.7,1313.2L255.7,1313.2    M255.7,1312.9L255.7,1312.9L255.7,1312.9 M255.7,1312.9L255.7,1312.9L255.7,1312.9 M255.7,1312.5L255.7,1312.5L255.7,1312.5"/>
    <path fill="#0961AA" d="M235.8,1277c8,9.6,13,22.3,13,35.6c0,30.9-24.9,55.8-55.8,55.8c-13.6,0-25.9-5-35.6-13   c9.3,11.3,23.3,18.9,38.9,20.3l0,0c0,0,0,0,0.3,0l0,0c0,0,0,0,0.3,0l0,0c0,0,0,0,0.3,0l0,0c0.3,0,0.3,0,0.7,0l0,0c0,0,0,0,0.3,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,0,0,0,0.3,0l0,0c0,0,0,0,0.3,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   l0,0c0,0,0,0,0.3,0c30.9,0,55.8-24.9,55.8-55.8l0,0c0,0,0,0,0-0.3l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0v-0.3   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0v-0.3l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0v-0.3l0,0   l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0c0,0,0,0,0-0.3l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0l0,0   C253.7,1298.3,246.4,1286,235.8,1277"/>
    <path fill="#0969C9" d="M202.5,1406.3c-33.2,0.3-83.1,17.6-93.7,41.6l-42.2,91.8c-2.3,5-3.7,10.3-3.3,15.3c0.7,2.7,2,5.3,4,8.3   c0.3,0.7,1,1.3,1.3,2c14.3,21.9,50.5,31.2,90.4,31.2h43.5V1406.3"/>
    <path fill="#64D88D" d="M373.3,1148.3l-147.5,85.8l0,0c0,0,0,0,0.3,0c15,4.3,28.2,12.3,38.9,23.3L373.3,1148.3"/>
    <path fill="#0969C9" d="M200.2,1166.3c19.6,0,38.2,4,55.5,10.6l46.9-27.3c-29.9-18.6-65.5-29.3-103.3-29.3   c-110.4,0.1-199.8,89.5-199.8,199.9c0,61.5,27.9,116.7,71.4,153.2l15.6-34.6c1.3-3.3,3.3-6.3,5.3-9.3   c-28.2-27.9-45.5-66.5-45.5-109.4C46.4,1235.1,115.1,1166.3,200.2,1166.3z"/>
    <path fill="#0961AA" d="M345.1,1268.3c6,16.3,9.3,33.6,9.3,51.9c0,42.9-17.3,81.4-45.5,109.4c2,3,3.7,6,5.3,9.3l15,33.2   c42.9-36.6,70.1-91.1,70.1-151.9c0-36.2-9.6-70.1-26.6-99.4L345.1,1268.3z"/>
</g>
</svg>

                                    </a></h1>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr><!-- end tr -->
            <tr>
                <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr>
                            <td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
                                <div class="text">
{{--                                    <h2>Bienvenue dans Irchad </h2>--}}
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">
                                <div class="text-author">

                                    <span class="position">
                                        <p>Bonjour {{$user['first_name']}}</p>
                                    <p>
                                       Pour vérifier le statut de votre candidature merci de vous connecter en utilisant les informations suivantes:
                                    </p>
                                        <table style="width: 288px;">
                                            <tbody>
                                            <tr>
                                                <td style="width: 166px;">&nbsp;Email</td>
                                                <td style="width: 267px;">&nbsp;<b>{{$user['email']}}</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 166px;">&nbsp;Mot de pass</td>
                                                <td style="width: 267px;">&nbsp;<b>{{$user['password']}}</b></td>
                                            </tr>
                                            <tr>
                                                <td>

                                                </td>
                                            </tr>

                                            </tbody>

                                        </table>
                                        <p>
                                            <br>
                                            L’équipe IRCHAD,

                                        </p>
                                    </span>

                                </div>

                            </td>
                        </tr>
                    </table>

                </td>

            </tr><!-- end tr -->

        </table>

    </div>
</center>
