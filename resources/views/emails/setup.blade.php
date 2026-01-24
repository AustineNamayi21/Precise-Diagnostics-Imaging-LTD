@extends('layouts.app')

@section('title', 'Email Setup - Precise Diagnostics')

@section('page-title', 'Email Configuration Setup')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-envelope me-2"></i> PHPMailer Configuration</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-info">
                    <h6 class="alert-heading"><i class="fas fa-info-circle me-2"></i> Current Configuration</h6>
                    <table class="table table-sm">
                        <tr>
                            <td><strong>Driver:</strong></td>
                            <td>{{ config('mail.default') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Host:</strong></td>
                            <td>{{ config('mail.mailers.phpmailer.host') }}</td>
                        </tr>
                        <tr>
                            <td><strong>Port:</strong></td>
                            <td>{{ config('mail.mailers.phpmailer.port') }}</td>
                        </tr>
                        <tr>
                            <td><strong>From Address:</strong></td>
                            <td>{{ config('mail.from.address') }}</td>
                        </tr>
                        <tr>
                            <td><strong>From Name:</strong></td>
                            <td>{{ config('mail.from.name') }}</td>
                        </tr>
                    </table>
                </div>
                
                <div class="mt-4">
                    <h6><i class="fas fa-cogs me-2"></i> Configuration Instructions</h6>
                    
                    <div class="alert alert-warning">
                        <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i> For Gmail Users</h6>
                        <p>If using Gmail, you must:</p>
                        <ol>
                            <li>Enable 2-Step Verification in your Google Account</li>
                            <li>Generate an "App Password"</li>
                            <li>Use the App Password in your .env file (not your regular password)</li>
                        </ol>
                        <a href="https://myaccount.google.com/security" target="_blank" class="btn btn-sm btn-outline-warning">
                            <i class="fas fa-external-link-alt me-1"></i> Go to Google Security
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <h6><i class="fas fa-check-circle me-2"></i> Test Your Configuration</h6>
                        <p>Click the button below to send a test email to your account:</p>
                        <form action="{{ route('mail.test') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-1"></i> Send Test Email
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="admin-card">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-code me-2"></i> .env Configuration</h6>
            </div>
            <div class="admin-card-body">
                <pre class="bg-light p-3 rounded small">
# For Gmail
MAIL_DRIVER=phpmailer
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="Precise Diagnostics Imaging"

# For SMTP Server
# MAIL_DRIVER=phpmailer
# MAIL_HOST=your-smtp-server.com
# MAIL_PORT=587
# MAIL_USERNAME=your-username
# MAIL_PASSWORD=your-password
# MAIL_ENCRYPTION=tls
# MAIL_FROM_ADDRESS=noreply@yourdomain.com
# MAIL_FROM_NAME="Precise Diagnostics Imaging"

# For Development (No emails sent)
# MAIL_DRIVER=log</pre>
            </div>
        </div>
        
        <div class="admin-card mt-4">
            <div class="admin-card-header">
                <h6 class="mb-0"><i class="fas fa-bug me-2"></i> Troubleshooting</h6>
            </div>
            <div class="admin-card-body">
                <div class="alert alert-danger">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-circle me-2"></i> Common Issues</h6>
                    <ul class="mb-0 small">
                        <li><strong>Authentication failed:</strong> Wrong password or need App Password for Gmail</li>
                        <li><strong>Connection refused:</strong> Check port and encryption settings</li>
                        <li><strong>SMTP Error:</strong> Verify SMTP server allows connections</li>
                        <li><strong>Email not sending:</strong> Check Laravel logs at storage/logs/laravel.log</li>
                    </ul>
                </div>
                
                <div class="mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary w-100">
                        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection