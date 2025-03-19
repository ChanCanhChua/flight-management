document.getElementById("flightForm").addEventListener("submit", function (event) {
    event.preventDefault(); 
    const originAp = document.querySelector("select[name='origin_ap']").value;
    const destinationAp = document.querySelector("select[name='destination_ap']").value;
    const flightTime = document.querySelector("input[name='flight_time']").value;

    if (!originAp) {
        customSwal( 'Vui lòng chọn điểm xuất phát!')
        return;
    }
  
    if (!destinationAp) {
        customSwal( 'Vui lòng chọn điểm đến!')
        return;
    }
    if (destinationAp === originAp) {
        customSwal( 'Điểm đi và điểm đến không được trùng nhau')
        return;
    }
    if (!flightTime) {
        customSwal('Vui lòng nhập thời gian bay!')
        return;
    }
  
    $.ajax({
        url: 'index',
        method: 'GET',
        data: $('form').serializeArray(),
        success: function(response) {
            $('.container-ticket').html(response.flightData);
        }
    });
});

