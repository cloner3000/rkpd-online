<form method="GET" action="{{ $action }}">
    <div class="m-input-icon m-input-icon--left">
        @if (!empty($selected_opd))
            <input type="hidden" name="selected_opd" value="{{ $selected_opd }}">
            <input type="hidden" name="selected_program" value="{{ $selected_program }}">
            <input type="hidden" name="old_dropdown1" value="{{ $old_dropdown1 }}">
        @endif
        <input type="text" name="search" class="form-control m-input m-input--solid"
               placeholder="Cari ..." id="generalSearch"
               value="{{ $search }}">
        <span class="m-input-icon__icon m-input-icon__icon--left">
            <span><i class="la la-search"></i></span>
        </span>
    </div>
</form>