
$(function () {
    $(document).on('click', '#delete', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure?',
            text: "Delete This Data?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })


    });

});



$(function () {
    $(document).on('click', '#confirm', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Confirm?',
            text: "Once confirmed, it can't be undo to Pending?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Confirmed!',
                    'Order is Confirmed.',
                    'success'
                )
            }
        })


    });

});


$(function () {
    $(document).on('click', '#processing', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Process the order?',
            text: "Once Processed, it can't be undo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Process it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Confirmed!',
                    'Order is Processed.',
                    'success'
                )
            }
        })


    });

});


$(function () {
    $(document).on('click', '#picked', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Picked the order?',
            text: "Once Picked, it can't be undo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Picked it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Picked!',
                    'Order is Picked.',
                    'success'
                )
            }
        })


    });

});



$(function () {
    $(document).on('click', '#shipped', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to Ship the order?',
            text: "Once Shipped, it can't be undo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Shipped it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Shipped!',
                    'Order is Shipped.',
                    'success'
                )
            }
        })


    });

});


$(function () {
    $(document).on('click', '#delivered', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to update to Delivered the order?',
            text: "Once Delivered, it can't be undo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delivered it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Delivered!',
                    'Order is Delivered.',
                    'success'
                )
            }
        })


    });

});



$(function () {
    $(document).on('click', '#reject', function (e) {
        e.preventDefault();
        var link = $(this).attr("href");


        Swal.fire({
            title: 'Are you sure to reject return request?',
            text: "Consider it, It can't be undone.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Reject it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link
                Swal.fire(
                    'Rejected!',
                    'Return Request is Rejected.',
                    'success'
                )
            }
        })


    });

});