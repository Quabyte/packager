function createSeats($json)
{
    axios({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        method: 'POST',
        url: '/dashboard/seat-map',
        data: {json: $json}
    })
        .then(function (response) {
            var stringed = JSON.stringify(response.data);
            console.log(stringed);
        })
        .catch(function (response) {
            alert(response);
        });
}

function selectedSeat(el) {
    var seat = el.target;

    axios({
        method: 'GET',
        url: '/seat-data/' + seat.uuid
    })
        .then(function (response) {
            alert(response.data[0]['category_id']);
        })
        .catch(function (error) {
            alert(error);
        });
}