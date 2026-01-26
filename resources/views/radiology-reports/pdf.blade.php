<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Radiology Report {{ $radiologyReport->report_number }}</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; font-size: 12px; color: #111; }
        .header { text-align: center; margin-bottom: 16px; }
        .header h2 { margin: 0; }
        .muted { color: #555; }
        .section { margin-top: 14px; }
        .section h4 { margin: 0 0 6px 0; font-size: 13px; border-bottom: 1px solid #ddd; padding-bottom: 4px; }
        table { width: 100%; border-collapse: collapse; }
        td { vertical-align: top; padding: 4px 0; }
        .k { width: 30%; color: #444; }
        .v { width: 70%; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Precise Diagnostics Imaging LTD</h2>
        <div class="muted">Radiology Report</div>
        <div class="muted">Report No: {{ $radiologyReport->report_number }}</div>
    </div>

    <table>
        <tr>
            <td class="k"><strong>Patient</strong></td>
            <td class="v">{{ optional($radiologyReport->serviceRecord->visit->patient)->full_name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="k"><strong>Email</strong></td>
            <td class="v">{{ optional($radiologyReport->serviceRecord->visit->patient)->email ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="k"><strong>Visit Date</strong></td>
            <td class="v">{{ optional($radiologyReport->serviceRecord->visit->visit_date)->format('F d, Y') ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="k"><strong>Procedure</strong></td>
            <td class="v">{{ optional($radiologyReport->serviceRecord->service)->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="k"><strong>Radiologist</strong></td>
            <td class="v">{{ optional($radiologyReport->radiologist)->name ?? 'N/A' }}</td>
        </tr>
        <tr>
            <td class="k"><strong>Status</strong></td>
            <td class="v">{{ ucfirst($radiologyReport->status) }}</td>
        </tr>
    </table>

    <div class="section">
        <h4>Clinical History</h4>
        <div>{!! nl2br(e($radiologyReport->clinical_history ?? '')) !!}</div>
    </div>

    <div class="section">
        <h4>Technique</h4>
        <div>{!! nl2br(e($radiologyReport->technique ?? '')) !!}</div>
    </div>

    <div class="section">
        <h4>Findings</h4>
        <div>{!! nl2br(e($radiologyReport->findings ?? '')) !!}</div>
    </div>

    <div class="section">
        <h4>Impression</h4>
        <div>{!! nl2br(e($radiologyReport->impression ?? '')) !!}</div>
    </div>

    @if($radiologyReport->recommendations)
    <div class="section">
        <h4>Recommendations</h4>
        <div>{!! nl2br(e($radiologyReport->recommendations)) !!}</div>
    </div>
    @endif

    <div class="section muted" style="margin-top: 20px;">
        Generated on {{ now()->format('Y-m-d H:i') }}
    </div>
</body>
</html>
