<div class="col-sm-12">
    <div class="row">
        <form action="{{ $action ?? '' }}" method="POST">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            @if (!empty($canEntry) && $canEntry && !(empty($canManage)) && $canManage )
                <a href="{{ $url ?? '#' }}"
                   class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill {{ $item->is_transfer ? 'disable-edit disabled' : ''}}"
                   title="Ubah" {{ $item->is_transfer ? 'disabled' : '' }}>
                    <i class="la la-edit"></i>
                </a>
                <button type="button"
                        class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"
                        data-toggle="modal" data-target="#modal_delete_{{ $id ?? "" }}" title="Hapus" {{ $item->is_transfer ? 'disabled' : '' }}>
                    <i class="la la-trash"></i>
                </button>
            @endif
            @include('global.table_action_modal_delete')
        </form>
        @if(!empty($show))
            <a href="{{ $show }}"
               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
               title="Detail">
                <i class="la la-eye"></i>
            </a>
        @endif
        @if(!(empty($canTransfer)) && $canTransfer)
            @if(!empty($isViewTransfer) && $isViewTransfer)
                <a href="{{ $transfer }}"
                   class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill {{ $item->is_transfer ? 'disabled' : '' }}">
                    <i class="la la-send"></i>
                </a>
            @else
                <form action="{{ $transfer }}"
                      method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $item->id }}" name="id_transfer">
                    <button type="button" {{ $item->is_transfer ? 'disabled' : '' }}
                            class="m-portlet__nav-link btn m-btn m-btn--hover-success m-btn--icon m-btn--icon-only m-btn--pill"
                            data-toggle="modal" data-target="#modal_transfer_{{ $id ?? "" }}" title="Trasfer"
                            type="button">
                        <i class="la la-send"></i>
                    </button>
                    @include('global.table_action_modal_transfer')
                </form>
            @endif
        @endif
    </div>
</div>
