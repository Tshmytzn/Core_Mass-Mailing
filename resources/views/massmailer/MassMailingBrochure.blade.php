<!doctype html>
<html lang="en">
@include('massmailer.components.head')
<body>
    <script src="{{asset('./dist/js/demo-theme.min.js?1692870487')}}"></script>
    <div class="page">
        @include('massmailer.components.loadingpage')
        @include('massmailer.components.nav', ['active' => 'massbrochure'])

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                Overview
                            </div>
                            <h2 class="page-title">
                                Mass Mailing Brochure
                            </h2>
                        </div>
                        <!-- Page title actions -->
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                <button class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-simple">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                        <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /></svg>
                                    Setting
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">

                        <div class="col-sm-6 col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="table-default" class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th><button class="table-sort" data-sort="sort-name">Name</button></th>
                                                    <th><button class="table-sort" data-sort="sort-email">Email</button></th>
                                                    <th><button class="table-sort" data-sort="sort-company">Company</button></th>
                                                    <th><button class="table-sort" data-sort="sort-type">Type</button></th>
                                                    <th><button class="table-sort" data-sort="sort-status">Status</button></th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-tbody">
                                                <tr>
                                                    <td class="sort-name">Steel Vengeance</td>
                                                    <td class="sort-email">Cedar Point, United States</td>
                                                    <td class="sort-company">RMC Hybrid</td>
                                                    <td class="sort-type">100,0%</td>
                                                    <td class="sort-status">August 04, 2021</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('massmailer.components.modal.MassBrochureModal')
            @include('massmailer.components.footer')
        </div>
    </div>
    @include('massmailer.components.script')
</body>

</html>
