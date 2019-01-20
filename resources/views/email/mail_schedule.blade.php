<!DOCTYPE html>
<html>
<head>
    <title>@lang('message.mail_title_report')</title>
</head>
<body>
    <h3>@lang('message.mail_preamble_report') {{ $user->name }}</h3>
    <p>@lang('message.mail_body_report') {{ $course->name }}</p>
    <p>@lang('message.mail_end_report')</p>
</body>
</html>
