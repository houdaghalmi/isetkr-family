<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Events Report - ISETKR Family</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            background-color: #f9f9f9;
        }
        
        .container {
            max-width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .logo {
            width: 150px;
            height: auto;
        }
        
        h1 {
            color: #2c3e50;
            font-weight: 600;
            margin: 0;
            font-size: 24px;
        }
        
        .report-info {
            text-align: right;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
            box-shadow: 0 0 0 1px #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
        }
        
        th {
            background-color: #3498db;
            color: white;
            font-weight: 500;
            text-align: left;
            padding: 12px 15px;
        }
        
        td {
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fa;
        }
        
        tr:hover {
            background-color: #f1f7fd;
        }
        
        .status-upcoming {
            color: #3498db;
            font-weight: 500;
        }
        
        .status-completed {
            color: #27ae60;
            font-weight: 500;
        }
        
        .status-cancelled {
            color: #e74c3c;
            font-weight: 500;
        }
        
        .date-cell {
            white-space: nowrap;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            text-align: right;
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }
        
        .signature-line {
            border-top: 1px solid #3498db;
            width: 200px;
            text-align: center;
            padding-top: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Events Report</h1>
                <p>Comprehensive list of all scheduled events</p>
            </div>
            <div class="report-info">
                <p>Generated on: {{ now()->format('d M Y H:i') }}</p>
                <p>Total Events: {{ count($events) }}</p>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Club</th>
                    <th>Intervenant</th>
                    <th>Date & Time</th>
                    <th>Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->club->name ?? '-' }}</td>
                    <td>{{ $event->intervenant }}</td>
                    <td class="date-cell">{{ $event->datetime ? \Carbon\Carbon::parse($event->datetime)->format('d M Y H:i') : '-' }}</td>
                    <td>{{ $event->location }}</td>
                    <td class="status-{{ strtolower($event->status) }}">{{ ucfirst($event->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="footer">
            <p>ISETKR Family - Connecting Students and Activities</p>
            <div class="signature">
                <div class="signature-line">
                    ISETKR Family Administration<br>
                    {{ now()->format('d F Y') }}
                </div>
            </div>
        </div>
    </div>
</body>
</html>