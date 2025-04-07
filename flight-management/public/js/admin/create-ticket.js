var originAPSelect;
var destinationAPSelect;
var table;
function handleChangeAirport() {    
    console.log($('#originAPSelect').val(),$('#destinationAPSelect').val());
    
    if(!isNaN(Number($('#originAPSelect').val())) && !isNaN(Number($('#destinationAPSelect').val())) && $('#originAPSelect').val()!== $('#destinationAPSelect').val()) {
      table.draw();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    originAPSelect = new NiceSelect.bind(document.getElementById("originAPSelect"), {searchable: true});
    destinationAPSelect = new NiceSelect.bind(document.getElementById("destinationAPSelect"), {searchable: true});
    flatpickr('#flight_time',{
        minDate: "today"
    })
    // document.querySelector('#createFlightModal').addEventListener('hidden.bs.modal', function (event) {
    //     $(`#citySelect option[value=null]`).prop('selected', true);
    //     $('.nice-select .current').text( $(`#citySelect option[value=null]`).text());
    //     $('#formCreateFlight').trigger("reset");
    // })
    $('#originAPSelect').on('change', function () {
        handleChangeAirport();
    });
    $('#destinationAPSelect').on('change', function () {
        handleChangeAirport();
    });
    // $('#createTicketModal').modal('show');

    table = new DataTable('#example', {
        serverSide: true,
        ajax: {
            url: 'available-list',
            type: 'GET',
            data: function(d) {
                d.origin_ap_id = $('#originAPSelect').val();
                d.destination_ap_id = $('#destinationAPSelect').val();
            },
            complete:function () {
                $(".overlay").fadeOut(300);

            },
        
        },
        language: {
            info: 'Hiển thị trang _PAGE_ đến _PAGES_',
            lengthMenu: "Hiển thị theo _MENU_ records",
            infoEmpty: "Không có dữ liệu",
            emptyTable: "Không tìm thấy dữ liệu phù hợp",
            search: "Tìm kiếm:",
        },
        columns: [
            { data: 'id', name: 'id', orderable: true, searchable: false},
            { data: 'origin_ap_name', name: 'origin_ap_name', orderable: true, searchable: true},
            { data: 'destination_ap_name', name: 'destination_ap_name', orderable: true, searchable: true},
            { data: 'price', name: 'price', orderable: true, searchable: true,
                render : function ( data, type, row, meta ){
                    if(data){
                        return  Number(data).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
                    }
                }
            },
            { data: 'flight_time', name: 'flight_time', orderable: true, searchable: false},
            // {data: "id", orderable: false, searchable: false, width: '10%' , render : function ( data, type, row, meta ) {
            //         return type === 'display'  ?
                        
            //                 `<button class="btn btn-sm border-secondary" onclick="handleUpdateFlight({
            //                          id: ${data},destination_ap_id: '${row.destination_ap_id}',
            //                          flight_time : '${row.flight_time}',
            //                         origin_ap_id: '${row.origin_ap_id}',
            //                         price: '${row.price}',
            //                         total_seat: '${row.total_seat}', type: 'update'})">
            //                     <i class="fa-solid fa-pen-to-square"></i>
            //                 </button>` :
            //             data;
            //     }},
        ],
        deferLoading: true 
    });
    
})
