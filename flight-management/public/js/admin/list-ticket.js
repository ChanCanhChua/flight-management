
var table

document.addEventListener("DOMContentLoaded", () => {
    const contentElement = document.querySelector('.content');
    table = new DataTable('#example', {
        serverSide: true,
        ajax: {
            url: 'list',
            type: 'GET',
            data: function(_d) {

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
            { data: 'passenger_name', name: 'passenger_name', orderable: true, searchable: true},
            { data: 'passenger_email', name: 'passenger_email', orderable: true, searchable: true},
            { data: 'passenger_tel', name: 'passenger_tel', orderable: true, searchable: false},
            { data: 'quantity', name: 'quantity', orderable: true, searchable: false},
            { data: 'amount_booked', name: 'amount_booked', orderable: true, searchable: false},
            { data: 'flight_date_time', name: 'flight_date_time', orderable: true, searchable: false},

            // { data: 'amount_booked', name: 'amount_booked', orderable: true, searchable: true,
            //     render : function ( data, _type, _row, _meta ){
            //         if(data){
            //             return  Number(data).toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
            //         }
            //     }
            // }
        ],
        scrollY: `calc(${contentElement.offsetHeight}px - 12rem)`,
    });

})
