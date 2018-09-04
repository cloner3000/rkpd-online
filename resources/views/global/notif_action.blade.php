<div class="m-alert m-alert--outline m-alert--outline-2x alert alert-{{ $type ?? "" }} alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    </button>
    <strong>{{ $alert ?? "" }}</strong> {{ $message ?? "" }}
</div>