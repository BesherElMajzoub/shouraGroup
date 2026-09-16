<!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>New Job Application</title>
</head>
<body style="margin:0;background:#f5f5f5;font-family:Tahoma,Arial,sans-serif;color:#1f2937">
    <div style="max-width:640px;margin:0 auto;padding:32px 16px">
        <div style="background:#ffffff;border-radius:16px;overflow:hidden;border:1px solid #e5e7eb">
            <div style="background:#d71920;color:#ffffff;padding:22px 28px">
                <h1 style="font-size:22px;margin:0">New Job Application</h1>
                <p style="margin:8px 0 0;color:#fee2e2;font-size:14px">A new application was submitted through the Shora Brothers website.</p>
            </div>

            <div style="padding:28px">
                <table role="presentation" style="width:100%;border-collapse:collapse;font-size:15px">
                    <tr><td style="padding:10px 0;color:#6b7280;width:150px">Name</td><td style="padding:10px 0;font-weight:bold">{{ $application->full_name }}</td></tr>
                    <tr><td style="padding:10px 0;color:#6b7280">Phone</td><td style="padding:10px 0" dir="ltr">{{ $application->phone }}</td></tr>
                    <tr><td style="padding:10px 0;color:#6b7280">Email</td><td style="padding:10px 0" dir="ltr">{{ $application->email }}</td></tr>
                    <tr><td style="padding:10px 0;color:#6b7280">Career Field</td><td style="padding:10px 0">{{ $application->department }}</td></tr>
                    <tr><td style="padding:10px 0;color:#6b7280">Preferred Branch</td><td style="padding:10px 0">{{ $application->preferred_branch }}</td></tr>
                </table>

                @if ($application->cover_letter)
                    <div style="margin-top:18px;padding:16px;background:#f9fafb;border-radius:10px;white-space:pre-line;line-height:1.8">{{ $application->cover_letter }}</div>
                @endif

                <p style="margin:24px 0 0;font-size:14px;color:#4b5563">The CV is attached to this email, and the application is also available in the website administration panel.</p>
                <a href="{{ route('admin.applications.show', $application) }}" style="display:inline-block;margin-top:16px;background:#111827;color:#ffffff;text-decoration:none;padding:11px 18px;border-radius:9px;font-weight:bold">View Application</a>
            </div>
        </div>
    </div>
</body>
</html>
