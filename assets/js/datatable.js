// Call the dataTables jQuery plugin to Tables

$(document).ready(function () {
  $('#userTable').DataTable(
    {
      "language": {
        "lengthMenu": '<div class=" border-0 form-control form-control-xl col-sm-12 text-start"> Entries <select>' +
          '<option value="10">10</option>' +
          '<option value="5">5</option>' +
          '<option value="15">15</option>' +
          '<option value="30">30</option>' +
          '<option value="60">60</option>' +
          '<option value="100">100</option>' +
          '<option value="-1">All</option>' +
          '</select></div>',
        "search": "<div class='bg-dark'>_INPUT_ </div>",
        "searchPlaceholder": "Search For:",
        "loadingRecords": 'Please wait - loading...',
        "scrollY": "500px",
        "paginate": false,
        "info": "Showing _START_ to _END_",
        "infoEmpty": "No entries to show"
      },

    });
});

