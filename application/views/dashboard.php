<?php
    $settings = json_decode($settings,true);
?>
<div class="container-fluid p-0 ">
    <div class="row mb-2 mb-xl-3">
        <div class="col-auto d-none d-sm-block">
            <h3><strong>Dashboard</strong></h3>
        </div>
        <div class="col-auto ms-auto text-end mt-n1">
            <button href="#" class="btn btn-primary" id = "sync_projects">Sync Projects</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="projects_table" class="table table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>Repo ID</th>
                                <th>Project Name</th>
                                <th>Stars</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="viewProjectPopUp" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">View Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <form id = "viewProjectForm" onsubmit = "return false;">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_repo_id">Repo ID</label>
                            <input type = "text" class = "form-control project_repo_id" readonly disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_name">Project Name</label>
                            <input type = "text" class = "form-control project_name" readonly disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_url">Project URL</label>
                            <input type = "text" class = "form-control project_url" readonly disabled>
                        </div>  
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_stars">Stars</label>
                            <input type = "text" class = "form-control project_stars" readonly disabled>
                        </div>  
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_created">Created Date</label>
                            <input type = "text" class = "form-control project_created" readonly disabled>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label" for="project_updated">Last Push Date</label>
                            <input type = "text" class = "form-control project_updated" readonly disabled>
                        </div>
                        <div class="mb-3 col-md-12">
                            <label class="form-label" for="project_description">Description</label>
                            <textarea readonly disabled class = "form-control project_description"></textarea>
                        </div>
                    </div>                                 
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>