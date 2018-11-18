
<!-- Bootstrap core JavaScript================================================= -->
<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">

<link rel="stylesheet" href="{{ asset('css/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<script src="{{ asset('js/tether/tether.min.js') }}" ></script>
<link rel="stylesheet" href="{{ asset('/plugins/datatables/datatables.css')}}">
<script src="{{ asset('/plugins/datatables/datatables.min.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/datetimepicker/bootstrap-datetimepicker.js') }}" charset="UTF-8"></script>

<script src="{{ asset('js/jQuery/jquery-ui.min.js') }}" charset="UTF-8"></script>
<link rel="stylesheet" href="{{ asset('css/jquery-ui.css')}}">

<link href={{ asset('css/bootstrap-datetimepicker.css')}} rel="stylesheet" media="screen">
<script type="text/javascript" src="{{ asset('js/datetimepicker/locales/bootstrap-datetimepicker.it.js') }}" charset="UTF-8"></script>













<script type="text/javascript">
    $(document).ready(function() {
        $('.responsive-table').DataTable({
            responsive: true,
            "paging": false,
            "searching": false,
            "ordering": false,
            "language": {
                "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
            }
        });
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show');
    });

</script>


<script type="text/javascript">
    $(".form_datetime").datetimepicker({
        format: 'dd-mm-yyyy hh:ii',
        autoclose: true,
        language: "<?php echo Config::get('app.locale'); ?>"
    });
</script>

<script type="text/javascript">
    $(".form_date").datetimepicker({
        minView: 2,
        format: 'dd-mm-yyyy',
        autoclose: true,
        language: "<?php echo Config::get('app.locale'); ?>"
    });


    $('#dateTimePic').on('click', function(e){
        var datetimeErrorDiv= document.getElementById('errorDateTime');
        datetimeErrorDiv.style.display = "none";
    })
</script>


<script type="text/javascript">
    $('div.timerHide').delay(4000).slideUp(300);
</script>


<script type="text/javascript">
    $(".delete").on("submit", function(){
        return confirm('{{__('member.sureToDelete')}}');
    });

</script>

<script type="text/javascript">
    $('.coll').click(function(){
        if($(this).hasClass('fa-caret-square-o-up')){
            $(this).addClass('fa-caret-square-o-down');
            $(this).removeClass('fa-caret-square-o-up');
        }
        else if($(this).hasClass('fa-caret-square-o-down')){
            $(this).addClass('fa-caret-square-o-up');
            $(this).removeClass('fa-caret-square-o-down');
        }

    });

</script>

<script type="text/javascript">

    var table1 = $('.datatable').DataTable({
        responsive:true,
        "lengthChange": false,
        "pagingType": "numbers",
        "info":     false,
        "language": {
            "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
        },
    });



    var table = $('#datatable-member').DataTable({
        responsive:true,
        "aoColumnDefs" : [{'bSortable': true, 'aTargets': [5]},{'bSearchable': false, 'aTargets': [5]}],
        "pageLength": 5,
        "autoWidth": true,
        "lengthChange": false,
        "pagingType": "first_last_numbers",
        "info":     false,
        "language": {
            "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('lessons.getMembers') }}',
        columns: [
            { data: 'nip', name: 'nip' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'birthdate', name: 'birthdate' },
            { data: 'description', name: 'description',visible : true , searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ],
        order: [[1, 'asc']]
    });




    function addMemberToLesson(id,np,first,last,birth)
    {
        //console.log(first);

        var actualMembers = document.getElementById("actual-members"),
            allMembers = document.getElementById("datatable-member"),
            maxMembers = document.getElementById("maxMembers").innerHTML,
            rowCount = document.getElementById('actual-members').rows.length,
            present='member'+id;


        //console.log(actualMembers);

        if(!$('#'+present).length) {
            if (rowCount <= maxMembers) {

                var newRow = actualMembers.insertRow(actualMembers.length),
                    uid = newRow.insertCell(0),
                    firstname = newRow.insertCell(1),
                    lastname = newRow.insertCell(2),
                    notes= newRow.insertCell(3),
                    allCourses= newRow.insertCell(4),
                    remove = newRow.insertCell(5);



                uid.style.width = '1%';
                firstname.style.width = '1%';
                lastname.style.width = '1%';
                remove.style.width = '1%';
                allCourses.innerHTML = "<input type=checkbox value="+id+" id=memberAllLesson"+id+" name=memberAllLesson[]> {{__('lesson.addMemberInEveryCourse')}}</input>";
                uid.innerHTML = "<input type=hidden value="+id+" id=member"+id+" name=member[]>"+id+"</input>";
                notes.innerHTML = "<textarea id=notes name=notes"+id+" rows=2 cols=30></textarea>";
                firstname.innerHTML = first;
                lastname.innerHTML = last;
                //remove.innerHTML = "<input type='button' class='btn fa-input' value='&#xf043;'/>";
                remove.innerHTML = "<a class='btn btn-primary'><i class='fa fa-trash-o' title='{{__('member.detach')}}'></i></a>";
            }
            else {
                return alert('{{__('lesson.cannotAddMoreMembers')}}');
            }
        }
        else {
            return alert('{{__('lesson.memberPresent')}}');
        }
    }


    var table = $('#datatable-member-direct').DataTable({
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.tableAll()
            }
        },
        "aoColumnDefs" : [{'bSortable': true, 'aTargets': [5]},{'bSearchable': false, 'aTargets': [5]}],
        "pageLength": 5,
        "autoWidth": true,
        "lengthChange": false,
        "pagingType": "first_last_numbers",
        "info":     false,
        "language": {
            "url": "{{ asset('/plugins/datatables/lang').'/'.Config::get('app.locale').'.json'}}"
        },
        processing: true,
        serverSide: true,
        ajax: '{{ route('lessons.getMembersDirect') }}',
        columns: [
            { data: 'nip', name: 'nip' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'birthdate', name: 'birthdate' ,visible : false},
            { data: 'description', name: 'description',visible : false , searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false}

        ],
        order: [[1, 'asc']]
    });

    $('#membersModal').on('shown.bs.modal', function (e) {
        table.columns.adjust()
        table.responsive.recalc();
    });



    function addMemberToLessonDirect(id)
    {
        console.log(id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: 'POST', // Type of response and matches what we said in the route
            url: '/admin/lessons/addMember/licenseMemberId', // This is the url we gave in the route
            data: {'licenseMemberId' : id},
            success: function(response){ // What to do if we succeed
                console.log(response);
                location.hash = '#tab2';

                //$('a[href="#tab1"]').trigger('click');
                $('a[href="#tab2"]').trigger('click');
                //location.reload();
                $('a[href="#tab2"]').trigger('click');
                //$("#tab1").removeClass("active");
               // $("#tab2").addClass("active");
               // classi=$("#tab2").attr("class");
               // console.log(classi);


            },
            error: function(jqXHR, textStatus, errorThrown) { // What to do if we fail
                console.log(JSON.stringify(jqXHR));
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }
        });

    }



    $('#actual-members').on('click', 'a', function(e){
        $(this).closest('tr').remove()
    })


    function validateLessonsCreateForm() {
        var dateValue = document.forms["formInsertLesson"]["date_time"].value;
        if (dateValue == "") {
            var datetimeErrorDiv= document.getElementById('errorDateTime');
            datetimeErrorDiv.style.display = "block";
            datetimeErrorDiv.innerHTML= '{{__('lesson.datetimeNotPresent')}}';

            $('html, body').animate({
                scrollTop: ($('#errorDateTime').offset().top - 300)
            }, 2000);
            return false;
        }
    }


    // Listen for click on toggle checkbox
    $('#select-all').click(function(event) {
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox').each(function() {
                this.checked = true;
            });
        } else {
            $(':checkbox').each(function() {
                this.checked = false;
            });
        }
    });


    $('#showMembers').click(function() {
        $("#allMembers").toggle( "slow" );
        $('html, body').animate({
            scrollTop: ($('#allMembers').offset().top - 300)
        }, 2000);
    });

</script>
