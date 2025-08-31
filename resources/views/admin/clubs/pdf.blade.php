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
        
        .status-active {
            color: #27ae60;
            font-weight: 500;
        }
        
        .status-inactive {
            color: #e74c3c;
            font-weight: 500;
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
                    <td>{{ $club->responsable->nom ?? '-' }}</td>
                    <td>{{ $club->events_count }}</td>
                    <td>{{ $club->members_count }}</td>
                    <td>{{ $club->created_at->format('d M Y') }}</td>
                    <td class="status-{{ strtolower($club->status) }}">{{ ucfirst($club->status) }}</td>
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