<form method="GET" action="{{ $action }}">
    <div class="m-input-icon m-input-icon--left">
        @role(\App\Enum\Roles::BIDANG)
        	<input type="hidden" name="selected_opd" value="{{ $selected_opd }}">
        	<input type="hidden" name="selected_program" value="{{ $selected_program }}">
        	<input type="hidden" name="old_dropdown1" value="{{ $old_dropdown1 }}">
        @endrole
        <input type="text" name="search" class="form-control m-input m-input--solid"
               placeholder="Cari ..." id="generalSearch"
               value="{{ $search }}">
        <span class="m-input-icon__icon m-input-icon__icon--left">
            <span><i class="la la-search"></i></span>
        </span>
    </div>
</form>