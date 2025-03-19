var originAPSelect;
var destinationAPSelect
var title = { 'create' : 'Thêm' , 'update': 'Cập nhật' , 'delete' : 'Xóa'}
const flightModal = new bootstrap.Modal('#createFlightModal', {
    keyboard: false
})
var table
function updateFlight (url = 'create', data = $('#formCreateFlight').serialize()){
    // var formData = new FormData(document.querySelector('#formCreateFlight'));
    var message = url === 'delete' ? data.message : $('#originAPInput').val();
    $.ajax({
        url: url,
        type:'POST',
        data: data,
        success: function(data) {
            customSweetAlert(`${title[url]} chuyến bay ${url !== 'delete' ? '' : message} thành công!`);
        },
        error: function(reject,data) {
            let message = '';
            $.each(reject.responseJSON.errors, function(key, val) {
                message += `${val}<br>`
            })
            customSweetAlert(message,'error');
        },
    }).done(function() {
        if(url==='create'){
            flightModal.hide();
        }
        table.draw();

    });
}
//hàm tạo sân bay
function handleAddFlight(){
    $('#formCreateFlight').on("submit", (event) => {
        event.preventDefault();
        updateFlight('create')
    });
}
function handlePreUpdate(data){
    $('#price').val(data.price);
    $('#flight_time').val(data.flight_time);
    $('#total_seat').val(data.total_seat);
    $(`#originAPSelect option[value=${data.origin_ap_id}]`).prop('selected', true);
    $(`#destinationAPSelect option[value=${data.destination_ap_id}]`).prop('selected', true);
    $('#originAPSelect').next().find('.current').text( $(`#originAPSelect option[value=${data.origin_ap_id}]`).text());
    $('#destinationAPSelect').next().find('.current').text( $(`#destinationAPSelect option[value=${data.destination_ap_id}]`).text());
    console.log(data.flight_time)
}
function handleUpdateFlight  (data){
    if(data.type !== 'delete'){
        $('#formCreateFlight').off('submit');
        flightModal.show();
    }
    switch (data.type){
        case 'create':
            $('#formCreateFlight').on("submit", (event) => {
                event.preventDefault();
                updateFlight('create')
            });
            break;
        case 'update':
            handlePreUpdate(data);
            $('#formCreateFlight').on("submit", (event) => {
                event.preventDefault();
                let form_data = $('form').serializeArray()
                form_data.push({name: "flight_id", value: data.id});
                console.log(form_data);
                updateFlight('update',$.param(form_data));
            });
            break;
        case 'delete':
            Swal.fire({
                title: `Bạn có chắc sẽ xóa chuyến bay từ ${data.origin_ap_name} đến ${data.destination_ap_name}?`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Xóa"
            }).then((result) => {
                if (result.isConfirmed) {
                    updateFlight('delete',{flight_id: data.id, message: `${data.origin_ap_name} đến ${data.destination_ap_name}` ,_token:  $('meta[name="csrf-token"]').attr('content')});
                }
            });
            break;
        default:
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const contentElement = document.querySelector('.content');
    table = new DataTable('#example', {
        serverSide: true,
        ajax: {
            url: 'list',
            type: 'GET',
            data: function(d) {

            },
            complete:function () {
                $(".overlay").fadeOut(300);
            }
        },
        language: {
            info: 'Hiển thị trang _PAGE_ đến _PAGES_',
            lengthMenu: "Hiển thị theo _MENU_ records",
            infoEmpty: "Không có dữ liệu",
            emptyTable: "Không tìm thấy dữ liệu phù hợp",
            search: "Tìm kiếm:",
        },
        columns: [
            { data: 'id', name: 'id', orderable: true, searchable: false,  visible: false },
            { data: 'flight_code', name: 'flight_code', orderable: true, searchable: false},
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
            { data: 'total_seat', name: 'total_seat', orderable: true, searchable: false},
            {data: "id", orderable: false, searchable: false, width: '10%' , render : function ( data, type, row, meta ) {
                    return type === 'display'  ?
                        `<div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-danger" onclick="handleUpdateFlight({id: ${data},destination_ap_name: '${row.destination_ap_name}',origin_ap_name: '${row.origin_ap_name}' , type: 'delete'})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button class="btn btn-sm border-secondary" onclick="handleUpdateFlight({
                                     id: ${data},destination_ap_id: '${row.destination_ap_id}',
                                     flight_time : '${row.flight_time}',
                                    origin_ap_id: '${row.origin_ap_id}',
                                    price: '${row.price}',
                                    total_seat: '${row.total_seat}', type: 'update'})">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        <div>` :
                        data;
                }},
        ],
        scrollY: `calc(${contentElement.offsetHeight}px - 12rem)`,
    });
    $('<button>')
        .html('<i class="fa fa-plus"></i> Thêm chuyến bay')  // Use an icon
        .addClass('btn btn-sm rounded-1 bg-purple text-white ms-3')
        .on('click', function() {
            handleUpdateFlight({type: 'create'});
        })
        .appendTo('.dt-length');
    // table.on('draw',() =>{
    //     handleUpdateFlight({type: 'create'});
    //
    // })
    originAPSelect = new NiceSelect.bind(document.getElementById("originAPSelect"), {searchable: true});
    destinationAPSelect = new NiceSelect.bind(document.getElementById("destinationAPSelect"), {searchable: true});
    flatpickr('#flight_time',{
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true
    })
    document.querySelector('#createFlightModal').addEventListener('hidden.bs.modal', function (event) {
        $(`#citySelect option[value=null]`).prop('selected', true);
        $('.nice-select .current').text( $(`#citySelect option[value=null]`).text());
        $('#formCreateFlight').trigger("reset");
    })
})
