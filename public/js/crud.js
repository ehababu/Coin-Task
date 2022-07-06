


function post(url, data, buttonId, redirectTo) {
    document.getElementById(buttonId).disabled = true;
    axios
        
        .post(url, data)
        .then(function (response) {
            toastr.success(response.data.message);
            if (redirectTo != undefined) {
                setTimeout(() => {
                    window.location.href = redirectTo;
                }, 500);
            } else {
                document.getElementById(buttonId).disabled = false;
            }
        })
        .catch(function (error) {
            document.getElementById(buttonId).disabled = false;
            toastr.error(error.response.data.message);
        });
}



function update(url, data, buttonId, redirectTo) {
    document.getElementById(buttonId).disabled = true;
    axios
        .put(url, data)
        .then(function (response) {
            toastr.success(response.data.message);
            if (redirectTo != undefined) {
                setTimeout(() => {
                    window.location.href = redirectTo;
                }, 500);
            } else {
                document.getElementById(buttonId).disabled = false;
            }
        })
        .catch(function (error) {
            document.getElementById(buttonId).disabled = false;
            toastr.error(error.response.data.message);
        });
}


function confirmDelete(url, id, reference) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            deleteItem(url, id, reference);
        }
    });
}

function deleteItem(url, id, reference) {
    axios
        .delete(url + '/' + id)
        .then(function (response) {
            reference.closest('tr').remove();
            showDeleteMessage(response.data);
        })
        .catch(function (error) {
            showDeleteMessage(error.response.data)
        });
}

function showDeleteMessage(data) {
    Swal.fire(data.title, data.message, data.icon);
}
