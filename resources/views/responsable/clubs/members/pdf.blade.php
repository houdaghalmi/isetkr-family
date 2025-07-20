<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $club->name }} Members</title>
    <style>
        @page {
            margin: 1.2cm;
            size: A4 portrait;
        }
        
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            line-height: 1.5;
            font-size: 12px;
        }
        
        .header {
            margin-bottom: 1.5rem;
            text-align: center;
        }
        
        .title {
            font-size: 1.5rem;
            font-weight: 500;
            color: #2d3480;
            margin-bottom: 0.25rem;
        }
        
        .subtitle {
            font-size: 0.85rem;
            color: #666;
        }
        
        .meta {
            margin-bottom: 1.5rem;
            text-align: right;
            font-size: 0.8rem;
            color: #666;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        th {
            text-align: left;
            padding: 0.5rem;
            border-bottom: 2px solid #2d3480;
            font-weight: 500;
            color: #2d3480;
        }
        
        td {
            padding: 0.5rem;
            border-bottom: 1px solid #eee;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
      
    </style>
</head>
<body>
    <div class="header">
        <div class="title">{{ $club->name }}</div>
    </div>
    
    <div class="meta">
        Generated on {{ now()->format('M j, Y') }} • {{ count($members) }} members
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Joined</th>
            </tr>
        </thead>
        <tbody>
            @foreach($members as $member)
            <tr>
                <td>{{ $member->nom }} {{ $member->prenom }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->numero ?? '-' }}</td>
                <td>{{ $member->pivot->function ?? '-' }}</td>
                <td>{{ $member->pivot->joined_at ? \Carbon\Carbon::parse($member->pivot->joined_at)->format('M d, Y') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    

</body>
</html>