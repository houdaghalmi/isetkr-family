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
            background-color: #f4f6f9;
        }
        
        .container {
            max-width: 100%;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.08);
            padding: 30px;
            margin: 20px auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2d3480;
        }
        
        h1 {
            color: #2d3480;
            font-weight: 600;
            margin: 0 0 5px 0;
            font-size: 24px;
        }
        
        .report-info {
            text-align: right;
            color: #555;
            font-size: 13px;
        }
        
        /* Event details box */
        .event-details {
            background-color: #f8f9fc;
            border: 1px solid #e0e0e0;
            border-left: 4px solid #f59e0b;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }
        
        .event-details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .detail-item strong {
            color: #3d4490;
            display: block;
            margin-bottom: 3px;
            font-size: 13px;
            font-weight: 600;
        }
        
        .detail-item span {
            font-size: 14px;
            color: #2d3480;
        }
        
        /* Table */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 15px;
            font-size: 13px;
            border-radius: 8px;
            overflow: hidden;
        }
        
        thead th {
            background: linear-gradient(90deg, #2d3480, #3d4490);
            color: #f59e0b;
            font-weight: 600;
            text-align: left;
            padding: 12px 15px;
            font-size: 13px;
            border-bottom: 2px solid #2d3480;
        }
        
        tbody td {
            padding: 10px 15px;
            border-bottom: 1px solid #e0e0e0;
            background-color: #fff;
        }
        
        tr:nth-child(even) td {
            background-color: #f8f9fc;
        }
        
        tr:hover td {
            background-color: #f1f4fb;
        }
        
        /* Status Badges */
        .status-present {
            color: #2d3480;
            font-weight: 600;
        }
        
        .status-absent {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .status-pending {
            color: #f59e0b;
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
        
        .participant-count {
            background-color: #2d3480;
            color: white;
            padding: 5px 12px;
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
                    <th> Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Class</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participants as $i => $participant)
                <tr>
                    <td>{{ $participant->user->nom  }} {{ $participant->user->prenom  }}</td>
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
            <p><strong>ISETKR Family</strong> – Event Management System</p>
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
