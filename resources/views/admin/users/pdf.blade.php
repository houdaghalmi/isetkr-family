<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Users Report - ISETKR Family</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6fb;
            margin: 0;
            padding: 30px;
            color: #333;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 25px;
            border-bottom: 3px solid #2d3480;
            padding-bottom: 15px;
        }

        h1 {
            margin: 0;
            font-size: 26px;
            font-weight: 600;
            color: #2d3480;
        }

        .header p {
            margin: 5px 0 0;
            color: #3d4490;
            font-size: 14px;
        }

        .report-info {
            text-align: right;
            font-size: 13px;
            color: #555;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 10px;
            border-radius: 10px;
            overflow: hidden;
        }

        thead th {
            background: linear-gradient(90deg, #2d3480, #3d4490);
            color: #f59e0b;
            font-weight: 500;
            padding: 10px 12px;
            text-align: left;
            font-size: 12px;
        }

        tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eaeaea;
        }

        tbody tr:nth-child(even) {
            background: #f9f9fc;
        }

        tbody tr:hover {
            background: rgba(45, 52, 128, 0.08);
        }

        /* Role badges */
        .role-badge {
            padding: 2px 5px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 500;
            display: inline-block;
        }

        .role-club_responsible {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .role-student {
            background: rgba(61, 68, 144, 0.15);
            color: #3d4490;
        }

      

     

        /* Footer */
        .footer {
            margin-top: 30px;
            border-top: 2px solid #eee;
            padding-top: 15px;
            font-size: 12px;
            color: #666;
            text-align: right;
        }

        .signature {
            margin-top: 40px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-line {
            border-top: 2px solid #f59e0b;
            width: 220px;
            text-align: center;
            padding-top: 6px;
            font-size: 12px;
            color: #2d3480;
            font-weight: 500;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1>Users Report</h1>
                <p>Comprehensive list of all system users</p>
            </div>
            <div class="report-info">
                <p>Generated on: {{ now()->format('d M Y H:i') }}</p>
                <p>Total Users: {{ count($users) }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th> Last Name </th>
                    <th> First Name </th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @if ($user->role!=='admin') 
                <tr>
                    <td>{{ $user->nom }} </td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->numero }}</td>
                    <td>
                        <span class="role-badge role-{{ strtolower($user->role) }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p>ISETKR Family - User Management System</p>
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