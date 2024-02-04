<!doctype html>
<html lang="en">

@php
$general = \App\Models\General::latest('created_at')->first();
@endphp

  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>{{ $general->company_name }} {{ $data['title'] }}</title>
    <style media="all" type="text/css">
        @media all {
        .btn-primary table td:hover {
            background-color: #9E6126!important;
        }

        .btn-primary a:hover {
            background-color: #9E6126!important;
            border-color: #9E6126!important;
        }
        }
        @media only screen and (max-width: 640px) {
        .main p,
        .main td,
        .main span {
            font-size: 16px !important;
        }

        .wrapper {
            padding: 8px !important;
        }

        .content {
            padding: 0 !important;
        }

        .container {
            padding: 0 !important;
            padding-top: 8px !important;
            width: 100% !important;
        }

        .main {
            border-left-width: 0 !important;
            border-radius: 0 !important;
            border-right-width: 0 !important;
        }

        .btn table {
            max-width: 100% !important;
            width: 100% !important;
        }

        .btn a {
            font-size: 16px !important;
            max-width: 100% !important;
            width: 100% !important;
        }
        }
        @media all {
        .ExternalClass {
            width: 100%;
        }

        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
            line-height: 100%;
        }

        .apple-link a {
            color: inherit !important;
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            text-decoration: none !important;
        }

        #MessageViewBody a {
            color: inherit;
            text-decoration: none;
            font-size: inherit;
            font-family: inherit;
            font-weight: inherit;
            line-height: inherit;
        }
        }
    </style>
  </head>

  <body style="font-family: Helvetica, sans-serif; -webkit-font-smoothing: antialiased; font-size: 16px; line-height: 1.3; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; background-color: #f4f5f6; margin: 0; padding: 0;">
    <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="body" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #f4f5f6; width: 100%;" width="100%" bgcolor="#f4f5f6">
      <tr>
        <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
        <td class="container" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; max-width: 600px; padding: 0; padding-top: 24px; width: 600px; margin: 0 auto;" width="600" valign="top">
          <div class="content" style="box-sizing: border-box; display: block; margin: 0 auto; max-width: 600px; padding: 0;">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader" style="color: transparent; display: none; height: 0; max-height: 0; max-width: 0; opacity: 0; overflow: hidden; mso-hide: all; visibility: hidden; width: 0;">{{ $general->company_name }} {{ $data['title'] }}</span>
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="main" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background: #ffffff; border: 1px solid #eaebed; border-radius: 16px; width: 100%;" width="100%">

              <!-- START MAIN CONTENT AREA -->
              <div class="logo" style="text-align: center;">
                <img class="img-fluid" style="max-width: 7rem; padding: 10px;" src="{{ (!empty($general ? $general->logo_sticky : '')) ? asset('uploads/general_images/'.$general->logo_sticky) : asset('frontend/img/logo.png') }}" class="navbar-brand-img mx-auto" alt="...">
              </div>
              <tr>
                <td class="wrapper" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; box-sizing: border-box; padding: 24px;" valign="top">
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">Hi {{ $data['name'] }},</p>
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">{{ $data['message'] }}. Follow the link below to sign in.</p>
                  <table role="presentation" border="0" cellpadding="0" cellspacing="0" class="btn btn-primary" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; box-sizing: border-box; width: 100%; min-width: 100%;" width="100%">
                    <tbody>
                      <tr>
                        <td align="left" style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; padding-bottom: 16px;" valign="top">
                          <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: auto;">
                            <tbody>
                              <tr>
                                <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top; border-radius: 4px; text-align: center; background-color: #CE7F36;" valign="top" align="center" bgcolor="#CE7F36"> <a href="{{ route('login') }}" target="_blank" style="border: solid 2px #CE7F36; border-radius: 4px; box-sizing: border-box; cursor: pointer; display: inline-block; font-size: 16px; font-weight: bold; margin: 0; padding: 10px 18px; text-decoration: none; text-transform: capitalize; background-color: #CE7F36; border-color: #CE7F36; color: #ffffff;">Sign In</a> </td>
                              </tr>
                            </tbody>
                          </table>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  {{-- <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">This is a really simple email template. It's sole purpose is to get the recipient to click the button with no distractions.</p>
                  <p style="font-family: Helvetica, sans-serif; font-size: 16px; font-weight: normal; margin: 0; margin-bottom: 16px;">Good luck! Hope it works.</p> --}}
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
              </table>

            <!-- START FOOTER -->
            <div class="footer" style="clear: both; padding-top: 24px; padding-bottom: 24px; text-align: center; width: 100%;">
              <table role="presentation" border="0" cellpadding="0" cellspacing="0" style="border-collapse: separate; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%;" width="100%">
                <tr>
                  <td class="content-block" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #12263f; font-size: 15px; text-align: center;" valign="top" align="center">
                    <span class="apple-link" style="color: #12263f; font-size: 15px; text-align: center;">{{ $general->address }}</span>
                    <br> Don't like these emails? <a href="#" style="text-decoration: underline; color: #12263f; font-size: 15px; text-align: center;">Unsubscribe</a>.
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by" style="font-family: Helvetica, sans-serif; vertical-align: top; color: #12263f; font-size: 15px; text-align: center;" valign="top" align="center">
                    Powered by <a href="{{ route('home') }}" style="color: #12263f; font-size: 15px; text-align: center; text-decoration: none;">{{ $general->company_name }}</a>
                  </td>
                </tr>
              </table>
            </div>

            <!-- END FOOTER -->

<!-- END CENTERED WHITE CONTAINER --></div>
        </td>
        <td style="font-family: Helvetica, sans-serif; font-size: 16px; vertical-align: top;" valign="top">&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
