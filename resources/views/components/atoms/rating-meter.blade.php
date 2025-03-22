@props(['rating' => 0, 'maxRating' => 5])

@php
    $percentage = ($rating / $maxRating) * 100;
@endphp

<div class="rating-meter">
    <div class="rating-fill" style="width: {{ $percentage }}%"></div>
</div>
