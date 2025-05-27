<div>
  <h2>Nouvelle commande reçue</h2>
  <p><strong>Nom :</strong> {{ $order->name }}</p>
  <p><strong>Email :</strong> {{ $order->email }}</p>
  <p><strong>Adresse :</strong> {{ $order->address }}</p>
  <p><strong>Ville :</strong> {{ $order->city }}</p>
  <p><strong>Code postal :</strong> {{ $order->postal_code ?? 'N/A' }}</p>
  <p><strong>Téléphone :</strong> {{ $order->phone }}</p>
  <p><strong>Mode de paiement :</strong> {{ $order->payment_method }}</p>
 @php
  $items = is_string($order->items) ? json_decode($order->items) : $order->items;
@endphp
@foreach ($items as $item)
  <li>{{ $item->name }} - Quantité : {{ $item->quantity }}</li>
@endforeach

  <p><strong>Total :</strong> {{ $order->total }}</p>
</div>