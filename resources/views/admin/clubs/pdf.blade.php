<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Clubs Report - ISETKR Family</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            background-color: #f4f6f9;
        }
        
        .container {
            max-width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2d3480;
        }
        
        h1 {
            color: #2d3480;
            font-weight: 600;
            margin: 0;
            font-size: 26px;
        }
        
        .header p {
            margin: 3px 0;
            color: #555;
            font-size: 14px;
        }
        
        .report-info {
            text-align: right;
            color: #555;
            font-size: 13px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        thead th {
            background: linear-gradient(90deg, #2d3480, #3d4490);
            color:#f59e0b;
            font-weight: 500;
            text-align: left;
            padding: 12px 15px;
        }
        
        td {
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        tr:nth-child(even) {
            background-color: #f8f9fc;
        }
        
        tr:hover {
            background-color: #f1f4fb;
        }
        
        .status-active {
            color: #2d3480;
            font-weight: 600;
        }
        
        .status-inactive {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #3d4490;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        
        .footer p {
            margin: 5px 0;
        }
        
        .signature {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }
        
        .signature-line {
            border-top: 2px solid #f59e0b;
            width: 220px;
            text-align: center;
            padding-top: 8px;
            font-size: 13px;
            color: #2d3480;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Clubs Report</h1>
                <p>Comprehensive list of all registered clubs</p>
            </div>
            <div class="report-info">
                <p>Generated on: {{ now()->format('d M Y H:i') }}</p>
                <p>Total Clubs: {{ count($clubs) }}</p>
            </div>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Club Name</th>
                    <th>Responsible</th>
                    <th>Events</th>
                    <th>Members</th>
                    <th>Created At</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clubs as $club)
                <tr>
                    <td>{{ $club->name }}</td>
                    <td>{{ $club->responsable->nom ?? 'Not Assigned' }}</td>
                    <td>{{ $club->events_count }}</td>
                    <td>{{ $club->members_count }}</td>
                    <td>{{ $club->created_at->format('d M Y') }}</td>
                    <td class="status-{{ strtolower($club->status) }}">{{ ucfirst($club->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="footer">
            <p><strong>ISETKR Family</strong> – More Than Clubs, It's Your Community</p>
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
