<!DOCTYPE html>
<html>
<head>
    <title>@lang('message.mail_title')</title>
</head>
<body>
    <h3>@lang('message.mail_preamble') {{ $user->name }}</h3>
    <p>@lang('message.mail_body') {{ $course->name }}</p>
    <p>@lang('message.mail_end')</p>
</body>
</html>
