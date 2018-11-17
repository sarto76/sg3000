<div class="modal fade" id="membersModal"
     tabindex="-1" role="dialog"
     aria-labelledby="membersModalLabel" style="margin: 20vh auto 0px auto">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"
                    id="favoritesModalLabel">{{__('member.list')}}</h4>
            </div>
            <div class="modal-body">

                    <div class="table-responsive">
                        <table id="datatable-member-direct" class="table table-hover table-bordered table-striped" name ="datatable" style="width:100%";cellspacing="0">
                            <thead>
                            <th>{{__('member.nip')}}</th>
                            <th>{{__('member.firstname')}}</th>
                            <th>{{__('member.lastname')}}</th>
                            <th>{{__('member.birthdate')}}</th>
                            <th>{{__('license.description')}}</th>
                            <th>{{__('member.addToLesson')}}</th>

                            </thead>
                        </table>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-default"
                        data-dismiss="modal">{{__('general.close')}}</button>
            </div>
        </div>
    </div>
</div>







