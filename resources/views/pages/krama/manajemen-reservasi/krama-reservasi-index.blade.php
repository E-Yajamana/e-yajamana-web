@extends('layouts.krama.krama-layout')
@section('tittle','Data Reservasi')

@push('css')
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-responsive/css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('base-template/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">

    <!-- DataTablbase-template Plugins -->
    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('base-template/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>

    <script src="{{asset('base-template/plugins/datatables/jquery.dataTables.js')}}"></script>



    <script src="{{asset('dataTables.rowsGroup.js')}}"></script>
@endpush

@section('content')
    <section class="content-header">
        <div class="container-fluid border-bottom">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Data Reservasi</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('krama.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Data Reservasi</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline tab-content">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h3 class="card-title">Filter Reservasi</h3>
                                </div>
                                <div class="col-6">
                                    <a class="btn btn-primary float-right" type="button" onclick="addReservasi()"> <i class="fa fa-plus"></i> Tambah Reservasi</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Semua</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Pending</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Tangkil</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Proses Muput</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Selesai</a></li>
                                        <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Batal</a></li>
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <select class="form-control select2" style="width: 100%;" aria-placeholder="ada">
                                        <option >Jenis Yadnya</option>
                                        <option>Dewa Yadnya</option>
                                        <option>Pitra Yadnya</option>
                                        <option>Manusa Yadnya</option>
                                        <option>Rsi Yadnya</option>
                                        <option>Bhuta Yadnya</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card tab-content" id="v-pills-tabContent">
                        <!-- Main content -->
                        <div class="card-header my-auto">
                            <h3 class="card-title my-auto">List Data Reservasi</h3>
                        </div>
                        <div class="tab-pane fade show active" id="sulinggih-table" role="tabpanel" aria-labelledby="sulinggih-tabs">
                            <div class="card-body p-0">
                                <div class="table-responsive mailbox-messages p-2">
                                    <table id="curriculum-students-dataTable" class="table mx-auto table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th class="tableColumnMediumWidth">Name</th>
                                                <th class="tableColumnMediumWidth">StudentID</th>
                                                <th class="tableColumnMediumWidth">Email</th>
                                                <th class="tableColumnMediumWidth">Unit</th>
                                                <th class="tableColumnMediumWidth">Placement</th>
                                                <th class="tableColumnMediumWidth">Site</th>
                                                <th class="tableColumnMediumWidth">Section</th>
                                                <th class="tableColumnMediumWidth">AdvisorSection</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th class="tableColumnMediumWidth">Name</th>
                                                <th class="tableColumnMediumWidth">StudentID</th>
                                                <th class="tableColumnMediumWidth">Email</th>
                                                <th class="tableColumnMediumWidth">Unit</th>
                                                <th class="tableColumnMediumWidth">Placement</th>
                                                <th class="tableColumnMediumWidth">Site</th>
                                                <th class="tableColumnMediumWidth">Section</th>
                                                <th class="tableColumnMediumWidth">AdvisorSection</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection

@push('js')
<script type="text/javascript">

    var model=[{"UserId":1311,"Email":"Carlos.Lopez@humbermail.ca.co","Password":null,"LastName":"Lopez","FirstName":"Carlos","StudentOrTeacherRegistrationNumber":"805687001","Section":"2","AdvisorSection":"0","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3520},
    {"UserId":1319,"Email":"David.Griffin@humbermail.ca.co","Password":null,"LastName":"Griffin","FirstName":"David","StudentOrTeacherRegistrationNumber":"804790491 ","Section":"7930sdd","AdvisorSection":"0ass","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3502},
    {"UserId":1648,"Email":"Scott.Meyer@humbermail.ca.co","Password":null,"LastName":"Meyer","FirstName":"Scott","StudentOrTeacherRegistrationNumber":"N00686366 ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3503},
    {"UserId":1693,"Email":"Robin.Long@humbermail.ca.co","Password":null,"LastName":"Long","FirstName":"Robin","StudentOrTeacherRegistrationNumber":"bllk0246","Section":"7930","AdvisorSection":"0","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3504},
    {"UserId":1738,"Email":"Robin.Long@humbermail.ca.co","Password":null,"LastName":"Long","FirstName":"Robin","StudentOrTeacherRegistrationNumber":"bllk0246","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3505},
    {"UserId":1739,"Email":"Michael.Long@humbermail.ca.co","Password":null,"LastName":"Long","FirstName":"Michael","StudentOrTeacherRegistrationNumber":"bkrj0147  ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3506},
    {"UserId":1740,"Email":"Ernest.Ray@humbermail.ca.co","Password":null,"LastName":"Ray","FirstName":"Ernest","StudentOrTeacherRegistrationNumber":"dmch0050  ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3507},
    {"UserId":1755,"Email":"Joyce.Robertson@humbermail.ca.co","Password":null,"LastName":"Robertson","FirstName":"Joyce","StudentOrTeacherRegistrationNumber":"brdm0412  ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3508},
    {"UserId":1877,"Email":"Clarence.Wells@humbermail.ca.co","Password":null,"LastName":"Wells","FirstName":"Clarence","StudentOrTeacherRegistrationNumber":"dmmr0027  ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3509},
    {"UserId":2093,"Email":"Jeremy.Mills@humbermail.ca.co","Password":null,"LastName":"Mills","FirstName":"Jeremy","StudentOrTeacherRegistrationNumber":"N00397173 ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3510},
    {"UserId":2307,"Email":"Rachel.Parker@humbermail.ca.co","Password":null,"LastName":"Parker","FirstName":"Rachel","StudentOrTeacherRegistrationNumber":"N00118511 ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3511},
    {"UserId":2350,"Email":"Frank.Wright@humbermail.ca.co","Password":null,"LastName":"Wright","FirstName":"Frank","StudentOrTeacherRegistrationNumber":"N00307407 ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3512},
    {"UserId":2434,"Email":"Charles.Harvey@humbermail.ca.co","Password":null,"LastName":"Harvey","FirstName":"Charles","StudentOrTeacherRegistrationNumber":"N00581144 ","Section":"7930","AdvisorSection":"0","Placement":"Agency","Site":"Bridgepoint","Unit":"2155-8","UnitId":177,"StudentOrTeacherUnitId":3513},
    {"UserId":4812,"Email":"fs12.lns12@yah.com","Password":null,"LastName":"lns12","FirstName":"fs12","StudentOrTeacherRegistrationNumber":"22","Section":"12","AdvisorSection":"34","Placement":"Agency","Site":"Dixon Grove JMS","Unit":"U8","UnitId":59,"StudentOrTeacherUnitId":3525},
    {"UserId":4812,"Email":"fs12.lns12@yah.com","Password":null,"LastName":"lns12","FirstName":"fs12","StudentOrTeacherRegistrationNumber":"22","Section":"2","AdvisorSection":"2","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3514},
    {"UserId":4812,"Email":"fs12.lns12@yah.com","Password":null,"LastName":"lns12","FirstName":"fs12","StudentOrTeacherRegistrationNumber":"22","Section":"45","AdvisorSection":"56","Placement":"Agency","Site":"AIDS Committee of Toronto (ACT)","Unit":"U3","UnitId":53,"StudentOrTeacherUnitId":3524},
    {"UserId":4813,"Email":"fs13.lns13@yah.com","Password":null,"LastName":"lns13","FirstName":"fs13","StudentOrTeacherRegistrationNumber":"3","Section":"2","AdvisorSection":"33","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3515},
    {"UserId":4813,"Email":"fs13.lns13@yah.com","Password":null,"LastName":"lns13","FirstName":"fs13","StudentOrTeacherRegistrationNumber":"3","Section":"gh","AdvisorSection":"hj","Placement":"Kindergarten","Site":"Claireville \u0026 James Bell","Unit":"K8","UnitId":97,"StudentOrTeacherUnitId":3526},
    {"UserId":4815,"Email":"fs15.lns15@yah.com","Password":null,"LastName":"lns15","FirstName":"fs15","StudentOrTeacherRegistrationNumber":"5","Section":"2","AdvisorSection":"5","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3516},
    {"UserId":4816,"Email":"fs16.lns16@yah.com","Password":null,"LastName":"lns16","FirstName":"fs16","StudentOrTeacherRegistrationNumber":"6","Section":"2","AdvisorSection":"77","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3517},
    {"UserId":5068,"Email":"raaaaa@raaaaa.ro","Password":null,"LastName":"raaaaa","FirstName":"raaaraa","StudentOrTeacherRegistrationNumber":"666","Section":"2","AdvisorSection":"asdsa","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3518},
    {"UserId":5072,"Email":"hsdhsd@dfsa.ro","Password":null,"LastName":"dfhdshs","FirstName":"fdhdfe","StudentOrTeacherRegistrationNumber":"455235","Section":"2","AdvisorSection":"asdsa","Placement":"NoPlacement","Site":"NoSite","Unit":"NoUnit","UnitId":233,"StudentOrTeacherUnitId":3519}];

   var curriculumStudentsDataTable;




   $(document).ready(function () {

           DisplayStudentsCurriculumTableData(model);

       });

   function DisplayStudentsCurriculumTableData(model) {
       curriculumStudentsDataTable = $('#curriculum-students-dataTable').dataTable({
           //"bRetrieve": true,
           "sPaginationType": "full_numbers",
           paging: true,
           //"bProcessing": true,
           //"bAutoWidth": false,
           //"bStateSave": true,
           "aaSorting": [[1, 'asc']],
           "aaData": model,
           rowsGroup: [0,1,2],
           "aoColumns": [
           {
               "data": function (data) {
                       return data.LastName+ ', ' +data.FirstName;
                   },
               sDefaultContent: ""
           },
           {
               "data": "StudentOrTeacherRegistrationNumber",
               sDefaultContent: ""
           },
           {
               "data": "Email",
               sDefaultContent: ""
           },
           {
               "data": "Unit",
               sDefaultContent: ""
           },
           {
               "data": "Placement",
               sDefaultContent: ""
           },
           {
               "data": "Site",
               sDefaultContent: ""
           },
           {
               "data": "Section",
               sDefaultContent: ""
           },
           {
               "data": "AdvisorSection",
               sDefaultContent: ""
           }
           ]
       });
   }
   </script>
@endpush
