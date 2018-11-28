<div class="modal fade" id="coursesModal"
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
                    id="favoritesModalLabel">{{__('lesson.list')}}</h4>
            </div>
            <div class="modal-body">

                    <div class="table-responsive">
                        <table id="datatable-show-lessons" class="table table-hover table-bordered table-striped" name ="datatable" style="width:100%";cellspacing="0">
                            <thead>
                            <th>{{__('course.number')}}</th>
                            <th>{{__('course.type')}}</th>
                            <th>{{__('lesson.number')}}</th>
                            <th>{{__('lesson.date_time')}}</th>
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







