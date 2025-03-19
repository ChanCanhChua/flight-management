var selectCity;
var title = { 'create' : 'Thêm' , 'update': 'Cập nhật' , 'delete' : 'Xóa'}
const airportModal = new bootstrap.Modal('#createAirportModal', {
    keyboard: false
})
var table
function updateAirport (url = 'create', data = $('#formCreateAirport').serialize()){
   
    var name = url === 'delete' ? data.name : $('#airportInput').val();
    $.ajax({
        url: url,
        type:'POST',
        data: data,
        success: function(data) {
            customSweetAlert(`${title[url]} sân bay ${url === 'create' ? '' : name} thành công!`);
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
            airportModal.hide();
        }
        table.draw();

    });
}
//hàm tạo sân bay
function handleAddAirport(){
    $('#formCreateAirport').on("submit", (event) => {
        event.preventDefault();
        updateAirport('create')
    });
}

 function handleUpdateAirport  (data){
    if(data.type !== 'delete'){
        $('#formCreateAirport').off('submit');
        airportModal.show();
    }
   switch (data.type){
       case 'create':
           $('#formCreateAirport').on("submit", (event) => {
               event.preventDefault();
               updateAirport('create')
           });
           break;
       case 'update':
           $('#airportInput').val(data.name);
           $(`#citySelect option[value=${data.city_id}]`).prop('selected', true);
           $('.nice-select .current').text( $(`#citySelect option[value=${data.city_id}]`).text());
           $('#formCreateAirport').on("submit", (event) => {
               event.preventDefault();
               let form_data = $('form').serializeArray()
               form_data.push({name: "airport_id", value: data.id});
               console.log(form_data);
                updateAirport('update',$.param(form_data));
           });
           break;
       case 'delete':
           Swal.fire({
               title: `Bạn có chắc sẽ xóa ${data.name}?`,
               icon: "warning",
               showCancelButton: true,
               confirmButtonColor: "#3085d6",
               cancelButtonColor: "#d33",
               confirmButtonText: "Xóa"
           }).then((result) => {
               if (result.isConfirmed) {
                   updateAirport('delete',{airport_id: data.id, name: data.name ,_token:  $('meta[name="csrf-token"]').attr('content')});
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
            { data: 'id', name: 'id', orderable: true, searchable: false},
            { data: 'name', name: 'name', orderable: true, searchable: true},
            { data: 'city', name: 'city', orderable: false, searchable: false},
            {data: "id", orderable: false, searchable: false, width: '10%' , render : function ( data, type, row, meta ) {
                    return type === 'display'  ?
                        `<div class="d-flex justify-content-end gap-2">
                            <button class="btn btn-sm btn-danger" onclick="handleUpdateAirport({id: ${data},name: '${row.name}', type: 'delete'})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <button class="btn btn-sm border-secondary" onclick="handleUpdateAirport({id: ${data}, name: '${row.name}',city_id : ${row.city_id}, type: 'update'})">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        <div>` :
                        data;
            }},
        ],
        scrollY: `calc(${contentElement.offsetHeight}px - 12rem)`,
    });
    $('<button>')
        .html('<i class="fa fa-plus"></i> Thêm Sân bay')  // Use an icon
        .addClass('btn btn-sm rounded-1 bg-purple text-white ms-3')
        .on('click', function() {
            handleUpdateAirport({type: 'create'});
        })
    .appendTo('.dt-length');
    // table.on('draw',() =>{
    //     handleUpdateAirport({type: 'create'});
    //
    // })
     selectCity = new NiceSelect.bind(document.getElementById("citySelect"), {searchable: true});

    document.querySelector('#createAirportModal').addEventListener('hidden.bs.modal', function (event) {
        $(`#citySelect option[value=null]`).prop('selected', true);
        $('.nice-select .current').text( $(`#citySelect option[value=null]`).text());
        $('#formCreateAirport').trigger("reset");
    })
})
