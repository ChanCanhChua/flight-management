var bookingInfo = [];
var currentBookingEl;
var total = 0;
function customSwal (text){
    Swal.fire({
        icon: 'warning',
        title: 'Thiếu thông tin',
        text: text,
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('vi-VN', { style: 'decimal' }).format(amount);
}

function handleUpdateQuantity() {
    $('#selected-flight').on('click','.flight .minus,.flight .add' ,function() {
        var $qty = $(this).closest('p').find('.qty'),
          currentVal = parseInt($qty.val()),
          isAdd = $(this).hasClass('add');
          var currentRemain = $(this).closest('.flight').find('.quantity-remain span').text();
          var currentFlightId = $(this).closest('.flight').data('id');
          var remain = $(this).closest('.flight').find('.quantity-remain').data('remain');

        if (!isNaN(currentVal)) {
            if (isAdd && currentVal < remain) {
                ++currentVal;
                $(this).closest('.flight').find('.quantity-remain span').text(--currentRemain);
                $('.flight-list').find(`.flight[data-id=${currentFlightId}] .quantity-remain span`).text(currentRemain);
            } else if (currentVal > 1 && currentVal < remain) {
                --currentVal;
                $(this).closest('.flight').find('.quantity-remain span').text( ++currentRemain);
                $('.flight-list').find(`.flight[data-id=${currentFlightId}] .quantity-remain span`).text(currentRemain);
            }
            $qty.val(currentVal);
        }
        const index = bookingInfo.findIndex((el)  => el.id === $(this).closest('.flight').data('id'));
        if (index >=0) {
            bookingInfo[index].quantity = currentVal;
            handleUpdateTotalPrice();
            $(this).closest('.flight').find('.quantity-remain').text()
        }      
    });

}


function handleUpdateTotalPrice(isReset = false) {
    if(isReset){
        $('#booking-price').text(0 + ' VNĐ');
        $('#vat-price').text(0 + ' VNĐ');
        $('#total-price').text(0 + ' VNĐ');
        $('.confirm-button').addClass('d-none')
    }else{
        total = bookingInfo.reduce((sum, item) => sum + item.price * item.quantity, 0);
        total > 0 ? $('.confirm-button').removeClass('d-none') :   $('.confirm-button').addClass('d-none');

        const bookingPrice = Math.floor(total);
        const vatPrice = Math.floor(bookingPrice * 0.1); 
        const totalPrice = bookingPrice + vatPrice; 

        $('#booking-price').text(formatCurrency(bookingPrice) + ' VNĐ');
        $('#vat-price').text(formatCurrency(vatPrice) + ' VNĐ');
        $('#total-price').text(formatCurrency(totalPrice) + ' VNĐ');
    }
}


function handleRemoveItem() {
    $('#selected-flight').on('click','.btn-remove' ,function(e) {
        var currentFlightId = $(this).closest('.flight').data('id');
        var remain = $(this).closest('.flight').find('.quantity-remain').data('remain');
        $('.flight-list').find(`.flight[data-id=${currentFlightId}] .quantity-remain span`).text(remain);
        bookingInfo = bookingInfo.filter((el)=> el.id !== parseInt(currentFlightId));
        handleUpdateTotalPrice();        
        $(this).closest('.flight').remove();
    });
}

function handleChooseFlight(){
    $('.flight .btn-choosing').on("click", function(e) {
        currentBookingEl = $(this).closest('.flight');
        
        var currentRemain = parseInt(currentBookingEl.find('.quantity-remain span').text());

        if (currentRemain <= 0) {
            customSwal('Số lượng vé đã hết. Không thể chọn thêm!');
            return;
        }

        if(!bookingInfo.some((el)  => el.id === currentBookingEl.data('id'))){
            bookingInfo.unshift({
                id: currentBookingEl.data('id'),
                quantity: 1,
                price: currentBookingEl.find('.price').data('price')
            });

            currentBookingEl.find('.quantity-remain span').text(--currentRemain);
            $('#selected-flight').
            prepend(currentBookingEl.clone().find('.btn-choosing').remove().end()
            .find('.action-item').removeClass('invisible').end());
            handleUpdateTotalPrice();
        }
    });
}

function handleSubmitBooking(){
    $('#passengerForm').on('submit',function (e) {
        e.preventDefault(); 
        let data = $('#passengerForm').serializeArray();
        let tickets = bookingInfo.map((el) => {
            return{
                flight_time_id : el.id,
                amount_booked: el.quantity*el.price,
                quantity: el.quantity
            }
        })
        data.push(
            { name: 'tickets', value: JSON.stringify(tickets) },
            { name: 'flight_date' ,value: $('#selected-flight .flight').data('time')}
        );
        $.ajax({
            url: 'store',
            method: 'POST',
            data: data,
            success: function(data) {
                customSweetAlert('Booking thành công!');
                $('#passengerForm').trigger('reset');
                $('#selected-flight').html('');
                $('#passengerModal').modal('hide')
                handleUpdateTotalPrice(true);
                bookingInfo = [];
                total = 0;
            },
            error: function(reject,data) {
                let message = '';
                $.each(reject.responseJSON.errors, function(key, val) {
                    message += `${val}<br>`
                })
                customSweetAlert(message,'error');
            },
        });
    })
}

document.addEventListener("DOMContentLoaded", () => {
    let urlParams = new URLSearchParams(window.location.search);
    flatpickr('#flight_time',{
        enableTime: false,
        minDate: "today",
        defaultDate: urlParams.get('flight_time')
    })
});

handleChooseFlight();
handleUpdateQuantity();
handleRemoveItem();
handleSubmitBooking();