$(function () {
    $("#example1").DataTable();

    $('.modal-delete-btn').on('click', function() {
        const id = $(this).attr('id')
        $('#modalDelete' + id).modal('show')
    })

    $('.submit-delete-btn').on('click', function () {
        const id = $(this).attr('id')
        $('#formDelete' + id).submit()
    })

    //Initialize Select2 Elements
    $(".select2").select2();
    
    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: "dd/mm/yy"
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });    
});

document.querySelectorAll('.sidebar-menu a').forEach(item => {
    if (item.href == location.href) {
        item.parentNode.classList.add('active')
    }
})

document.querySelector('tbody').addEventListener('click', event => {
    event.preventDefault()

    if (event.target.dataset.type == 'status') {
        let id = event.target.dataset.id
        let url = location.origin + '/admin/comments/status/' + id
        fetch(url)
            .then(response => response.json())
            .then(data => {
                toggleCommentStatus(id, data)
            })

    }
})

function toggleCommentStatus(id, data) {
    let btn = document.querySelector(`.btn[data-id="${id}"]`)
    if (data.status == 0) {
        btn.textContent = 'deny'
        btn.classList.remove('btn-success')
        btn.classList.add('btn-danger')
    } else {
        btn.textContent = 'allowed'
        btn.classList.remove('btn-danger')
        btn.classList.add('btn-success')
    }

    document.getElementById('newCommentsCount').textContent = data.newCommentsCount
}