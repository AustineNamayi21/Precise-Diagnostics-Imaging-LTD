<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Radiology Report - {{ config('app.name') }}</title>
    <style>
        /* Same email template as before */
        body { font-family: 'Segoe UI', sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #0ea5e9 0%, #0d9488 100%); color: white; padding: 30px 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background-color: white; padding: 30px; border: 1px solid #e1e5eb; border-top: none; border-radius: 0 0 10px 10px; }
        .logo { font-size: 24px; font-weight: bold; margin-bottom: 10px; }
        .patient-info { background-color: #f8fafc; border-left: 4px solid #0ea5e9; padding: 15px; margin: 20px 0; border-radius: 4px; }
        .details-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin: 20px 0; }
        .detail-item { padding: 10px; background-color: #f8fafc; border-radius: 5px; }
        .detail-label { font-weight: 600; color: #64748b; font-size: 12px; text-transform: uppercase; }
        .detail-value { font-weight: 500; color: #1e293b; margin-top: 5px; }
        .important-note { background-color: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 25px 0; border-radius: 4px; }
        .footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid #e1e5eb; font-size: 12px; color: #64748b; text-align: center; }
        @media (max-width: 600px) { .details-grid { grid-template-columns: 1fr; } }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">{{ config('app.name', 'Precise Diagnostics Imaging') }}</div>
        <div style="opacity: 0.9;">Radiology Report Delivery</div>
    </div>
    
    <div class="content">
        <h2>Your Radiology Report is Ready</h2>
        
        <p>Dear {{ $patient->first_name }} {{ $patient->last_name }},</p>
        
        <p>Your radiology report has been completed and is attached to this email. Here are the details:</p>
        
        <div class="details-grid">
            <div class="detail-item">
                <div class="detail-label">Report Number</div>
                <div class="detail-value">{{ $report->report_number }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Service Type</div>
                <div class="detail-value">{{ $report->serviceRecord->service->name }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Exam Date</div>
                <div class="detail-value">{{ $report->serviceRecord->service_date->format('F d, Y') }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Radiologist</div>
                <div class="detail-value">Dr. {{ $report->radiologist->name ?? 'Radiologist' }}</div>
            </div>
        </div>
        
        <div class="important-note">
            <strong>⚠️ Important:</strong> Please review this report with your healthcare provider. 
            This information is for medical purposes and should be interpreted by a qualified physician.
        </div>
        
        <div class="footer">
            <p>{{ config('app.name', 'Precise Diagnostics Imaging') }}</p>
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>For questions, contact our clinic directly.</p>
        </div>
    </div>
</body>
</html>