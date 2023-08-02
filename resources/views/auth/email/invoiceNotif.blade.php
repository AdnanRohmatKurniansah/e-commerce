<h4>Dear {{ $ord->fname }} {{ $ord->lname }}, </h4>
   
<p>This is a billing reminder that your invoice no. #INV{{ str_pad($ord->id, 5, '0', STR_PAD_LEFT) }} which was generated on {{ $ord->created_at->format('d M Y h:i') }} is due on {{ \Carbon\Carbon::parse($ord->due_date)->format('d M Y h:i') }}.</p>

Invoice: #INV{{ str_pad($ord->id, 5, '0', STR_PAD_LEFT) }}<br>
Balance Due: Rp. {{ number_format($ord->total, 0, ',', '.') }}<br>
Due Date: {{ \Carbon\Carbon::parse($ord->due_date)->format('d M Y h:i') }}

<p>You can login to your client area to view and pay the invoice at <a href="http://localhost:7000/invoice/{{ Crypt::encryptString($order) }}">This link</a></p>
