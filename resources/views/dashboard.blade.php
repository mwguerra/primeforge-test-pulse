<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5">
    <title>Pulse - Scheduler & Queue Monitor</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #0f172a; color: #e2e8f0; padding: 2rem; }
        .header { text-align: center; margin-bottom: 2rem; }
        .header h1 { font-size: 2rem; color: #f8fafc; margin-bottom: 0.5rem; }
        .header p { color: #94a3b8; }
        .stats { display: flex; gap: 1rem; justify-content: center; margin-bottom: 2rem; }
        .stat { background: #1e293b; border-radius: 0.75rem; padding: 1.25rem 2rem; text-align: center; min-width: 160px; }
        .stat .number { font-size: 2rem; font-weight: bold; }
        .stat .label { font-size: 0.875rem; color: #94a3b8; margin-top: 0.25rem; }
        .stat.scheduler .number { color: #4ade80; }
        .stat.queue .number { color: #60a5fa; }
        .stat.total .number { color: #c084fc; }
        table { width: 100%; max-width: 800px; margin: 0 auto; border-collapse: collapse; }
        th { background: #1e293b; padding: 0.75rem 1rem; text-align: left; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; color: #94a3b8; }
        td { padding: 0.75rem 1rem; border-bottom: 1px solid #1e293b; }
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; }
        .badge.scheduler { background: #065f46; color: #4ade80; }
        .badge.queue { background: #1e3a5f; color: #60a5fa; }
        .time { color: #94a3b8; font-size: 0.875rem; font-family: monospace; }
        .empty { text-align: center; padding: 3rem; color: #64748b; }
        .refresh-note { text-align: center; margin-top: 1.5rem; font-size: 0.75rem; color: #475569; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pulse</h1>
        <p>Scheduler & Queue Activity Monitor</p>
    </div>

    <div class="stats">
        <div class="stat scheduler">
            <div class="number">{{ $schedulerCount }}</div>
            <div class="label">Scheduler Ticks</div>
        </div>
        <div class="stat queue">
            <div class="number">{{ $queueCount }}</div>
            <div class="label">Queue Jobs</div>
        </div>
        <div class="stat total">
            <div class="number">{{ $schedulerCount + $queueCount }}</div>
            <div class="label">Total Events</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Source</th>
                <th>Message</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            @forelse($heartbeats as $hb)
                <tr>
                    <td><span class="badge {{ $hb->source }}">{{ $hb->source }}</span></td>
                    <td>{{ $hb->message }}</td>
                    <td class="time">{{ $hb->created_at->format('H:i:s') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="empty">
                        Waiting for heartbeats... The scheduler runs every 10 seconds.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p class="refresh-note">Auto-refreshes every 5 seconds</p>
</body>
</html>
