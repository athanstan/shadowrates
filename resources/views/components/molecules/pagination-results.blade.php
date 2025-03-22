@props(['paginator'])

<div class="mb-4 text-purple-300 text-sm">
    @if ($paginator->total() > 0)
        Showing {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} of {{ $paginator->total() }} items
    @else
        No items found
    @endif
</div>
