<form action="{{ $action ?? '' }}" method="POST">
    {{ method_field('DELETE') }}
    {{ csrf_field() }}
    <a href="{{ $url ?? '#' }}"
       class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"
       title="Ubah">
        <i class="la la-edit"></i>
    </a>
    <button type="button"
            class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
            data-toggle="modal" data-target="#modal_delete_{{ $id ?? "" }}" title="Hapus">
        <i class="la la-trash"></i>
    </button>
    @include('global.table_action_modal_delete')
    @if(!empty($show))
        <a href="{{ $show }}"
           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
           title="Detail">
            <i class="la la-eye"></i>
        </a>
    @endif
</form>