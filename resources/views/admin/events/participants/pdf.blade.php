<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Event Participants Report - ISETKR Family</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }
        
        .container {
            max-width: 100%;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
            padding: 30px;
            margin: 20px auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 1px solid #eee;
        }
        
        .logo {
            height: 50px;
        }
        
        h1 {
            color: #2c3e50;
            font-weight: 600;
            margin: 0 0 5px 0;
            font-size: 22px;
        }
        
        .report-info {
            text-align: right;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .event-details {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .event-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .detail-item strong {
            color: #3498db;
            display: block;
            margin-bottom: 3px;
            font-size: 13px;
        }
        
        .detail-item span {
            font-size: 14px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 13px;
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
            font-size: 13px;
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
        
        /* Status Badges */
        .status-present {
            color: #27ae60;
            font-weight: 500;
        }
        
        .status-absent {
            color: #e74c3c;
            font-weight: 500;
        }
        
        .status-pending {
            color: #f39c12;
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
        
        .participant-count {
            background-color: #3498db;
            color: white;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 13px;
            margin-bottom: 15px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Event Participants Report</h1>
            </div>
            <div class="report-info">
                <p>Generated on: {{ now()->format('d M Y H:i') }}</p>
                <p>Total Participants: {{ count($participants) }}</p>
            </div>
        </div>
        
        <div class="event-details">
            <div class="event-details-grid">
                <div class="detail-item">
                    <strong>Event Title</strong>
                    <span>{{ $event->title }}</span>
                </div>
                <div class="detail-item">
                    <strong>Date & Time</strong>
                    <span>{{ $event->datetime ? \Carbon\Carbon::parse($event->datetime)->format('d M Y H:i') : '-' }}</span>
                </div>
                <div class="detail-item">
                    <strong>Location</strong>
                    <span>{{ $event->location }}</span>
                </div>
                <div class="detail-item">
                    <strong>Organizing Club</strong>
                    <span>{{ $event->club->name ?? '-' }}</span>
                </div>
            </div>
        </div>
        
        
        
        <table>
            <thead>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $i => $participant)
                <tr>
                    <td>{{ $participant->user->nom ?? '-' }}</td>
                    <td>{{ $participant->user->prenom ?? '-' }}</td>
                    <td>{{ $participant->user->email ?? '-' }}</td>
                    <td>{{ $participant->user->numero ?? '-' }}</td>
                    <td>{{ $participant->classe ?? '-' }}</td>
                    <td class="status-{{ strtolower($participant->participation_status ?? 'pending') }}">
                        {{ ucfirst($participant->participation_status ?? 'Pending') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
        <div class="footer">
            <p>ISETKR Family - Event Management System</p>
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