async function runPageApp(){
    loader_start();
    runProjects();
}
$(document).ready(function() {
    runPageApp();
});
async function runProjects(){
    $('#projects_table').dataTable().fnDestroy();	
    $("#projects_table").DataTable({
        ajax: {
            url: route_control_api + "get-projects",
            type: "POST",          
            webpage_loader:false
        },
        processing: true,
        serverSide: true,
        searchDelay: 1000,
        responsive: true,
        pageLength: 10,
        ordering: true,
        order: [[2, 'desc']],
        pageResize: true,
        scrollY: '45vh',
        scrollCollapse: false,
        language: {
            searchPlaceholder: "Search By Name/ID",
        },        
        columns: [
            { data: "repo_id"},
            { data: "name"},
            {
                data:  function (data, type, dataToSet) {
                    return numberWithCommas(data.stars) + " Stars";
                },
            }, 
            {
                orderable: false, data:  function (data, type, dataToSet) {
                    return '<button type="button" class="btn btn-primary viewProject" data-bs-toggle="modal" data-bs-target="#viewProjectPopUp">' +
                        'View' +
                    '</button>';
                },
            }, 
        ],
    });
}
$(document).on('click', "#sync_projects", function(){
    $("#sync_projects").html('Please Wait...');
    $("#sync_projects").attr('disabled','disabled');  
    $.ajax({
        type:'POST',
        url: route_control_api + "sync-projects",
        success: function(data)
        {
            $("#sync_projects").html('Sync Projects');
            $("#sync_projects").removeAttr('disabled');
            var response = JSON.parse(data);
            if(response.status == 0){
                if(Object.keys(response.errors).length > 0){
                    for(var key in response.errors){
                        if(response.errors[key] != ""){
                            popupNotification(response.errors[key], 'error');
                        }                            
                    }
                } else {
                    popupNotification(response.error, 'error');
                }
            } else if(response.status == 1){
                popupNotification(response.text, 'success');
                $('#projects_table').DataTable().ajax.reload(null, false);
            }
        },
        error: function(error)
        {
            $("#sync_projects").html('Sync Projects');
            $("#sync_projects").removeAttr('disabled');
            popupNotification("Unknown Error. If persists, please contact support", 'error');
            console.log(error);
        }
    });

    
})
$(document).on('click', '.viewProject', function(){
    var tr = $(this).closest('tr');
    if(tr.hasClass("child")){
        tr = tr.prev("tr");
        var row = $("#projects_table").DataTable().row( tr );
    } else {
        var row = $("#projects_table").DataTable().row( tr );
    }
    var rowData = row.data();
    var form = $("#viewProjectForm");
    form.find(".project_repo_id").val(rowData.repo_id);
    form.find(".project_name").val(rowData.name);
    form.find(".project_url").val(rowData.url);
    form.find(".project_created").val(rowData.created_date);
    form.find(".project_updated").val(rowData.last_push_date);
    form.find(".project_description").val(rowData.description);
    form.find(".project_stars").val(rowData.stars);
})