# Security Practices

## Implemented Controls
- **CSRF protection** for authentication forms.
- **Session hardening**: strict mode, HTTP-only cookies, session regeneration on login/logout.
- **Password hashing** using `password_hash`.
- **Prepared statements** with PDO for all DB operations.
- **Basic rate limiting** for login attempts (session-based).
- **Storage protection** via `.htaccess` to block direct access.

## Required Operational Controls
- Use HTTPS in production.
- Set secure PHP session cookie settings (`secure`, `samesite`) at the hosting level.
- Configure SMTP credentials in environment variables (planned module).
- Configure file upload limits and MIME validation for document storage (planned module).

## Known Gaps (Planned)
- Full RBAC enforcement in controllers and middleware.
- Audit logging hooks across all modules.
- Secure file upload and antivirus scanning.
- MFA/OTP support for privileged users.
